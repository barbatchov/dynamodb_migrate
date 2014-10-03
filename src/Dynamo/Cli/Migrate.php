<?php
namespace Dynamo\Cli;

use \Dynamo\MigrableException;
use \Dynamo\Repository;

use \Aws\DynamoDb\Exception\ResourceInUseException;
use \Aws\DynamoDb\Exception\ResourceNotFoundException;

require_once __DIR__ . '/../../../bootstrap.php';

class Migrate
{
    private $changelog;
    private $migrationPath;

    /** @var Dynamo\Repository */
    private $repository;

    public function __construct($args = [])
    {
        foreach ($args as $method => $value) {
            (method_exists($this, $method)) &&
                $this->{$method}($value);
        }
    }

    /**
     * @return \Dynamo\Repository
     */
    public function getRepository()
    {
        if (!$this->repository) {
            $this->repository = new Repository();
        }

        return $this->repository;
    }

    /**
     * @param string $file
     */
    public function setChangelog($file = '')
    {
        if (!file_exists($file)) {
            file_put_contents($file, "");
        }

        $this->changelog = $file;
    }

    /**
     * @param string $path
     */
    public function setMigrationPath($path = '')
    {
        $this->migrationPath = $path;
    }

    /**
     * @param string $file
     * @throws \Exception
     * @throws \Dynamo\MigrableException
     */
    public function doMigration($file = '')
    {
        if (!file_exists($file)) {
            $msg = "Migration is missing into $file";
            throw new \Exception($msg);
        }

        if (!dirname($this->migrationPath)) {
            $msg = "Migration path not found in {$this->migrationPath}";
            throw new \Exception($msg);
        }

        preg_match('/(?:.*?\/)+(?:(\d+)-(.*?).php)/', $file, $matches);

        if (isset($matches[1]) && isset($matches[2])) {
            $func = create_function('$c', 'return str_replace(\'_\', \'\', strtoupper($c[1]));');
            $class = 'Dynamo\Migrations\\' .
                ucfirst(preg_replace_callback('/(_.)/', $func, $matches[2]) . $matches[1]);
        }

        /* @var $dbClient Aws\DynamoDb\DynamoDbClient */
        $dbClient = $this->getRepository()->getDynamoDbClient();

        require_once $file;
        
        /* @var $migrable \Dynamo\MigrableAbstract */
        $migrable = new $class($dbClient);
        try {
            $migrable->doMigration();
            
            $openedFile = fopen($file, 'a');
            fwrite($openedFile, $file . PHP_EOL) && 
                fclose($openedFile);
        
        } catch (ResourceInUseException $e) {
            throw new MigrableException($e->getMessage(), 0, $e);
        } catch (ResourceNotFoundException $e) {
            throw new MigrableException($e->getMessage(), 0, $e);
        } catch (\Exception $e) {
            throw new MigrableException($e->getMessage(), 0, $e);
        }
    }

    /**
     * @param array $args
     */
    public static function run($args = [])
    {
        $theArgs = [];

        foreach ($args as $key => $value) {
            if ($key == 0) {
                continue;
            }

            preg_match('/--(.*?)=(.*)/', $value, $matches);

            (isset($matches[1])) &&
                $theArgs[$matches[1]] = (isset($matches[2])) ? $matches[2] : "";
        }

        new Migrate($theArgs);
    }
}

Migrate::run($argv);
