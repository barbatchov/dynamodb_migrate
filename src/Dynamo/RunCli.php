<?php
namespace \Dynamo;

require_once __DIR__ . '/../../bootstrap.php';

class RunCli
{
    public static function run($args = [])
    {
        $theArgs = [];
        $class   = null;

        foreach (self::$args as $key => $value) {
            if ($key == 0) {
                continue;
            }

            if ($key == 1) {
                
                $reflection = new \ReflectionClass($value);
                ($reflection->implementsInterface('\Dynamo\Cli\RunnableInterface')) &&
                    $class = new $value();
                
                continue;
            }

            preg_match('/--(.*?)=(.*)/', $value, $matches);

            (isset($matches[1])) &&
                $theArgs[$matches[1]] = (isset($matches[2])) ? $matches[2] : "";
        }

        $class->run($theArgs);
        
    }
}

RunCli::run($argv);