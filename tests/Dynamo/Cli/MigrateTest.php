<?php
namespace Dynamo\Cli;

use \Dynamo\Cli\Migrate;

class MigrateTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldCreate()
    {
        $runnable = new Migrate();
        $this->assertInstanceOf('\Dynamo\Cli\Migrate', $runnable);
    }
    
    public function testShouldGetRepository()
    {
        $runnable = new Migrate();
        $repository = $runnable->getRepository();
        
        $this->assertInstanceOf('\Dynamo\Repository', $repository);
    }
    
    public function testShouldCreateMigration()
    {
        
        $args = [
            'setChangelog' => '/tmp/migrate-test-changelog.log',
            'setMigrationPath' => '/tmp/',
            'doMigration' => $this->createMigration(),
        ];
        
        $runnable = new Migrate();
        $runnable->run($args);
    }
    
    private function createMigration()
    {
        $tpl = file_get_contents(ROOT_DIR . '/src/resources/MigrationMock.php.tpl');
        $parsed = str_replace('${migrationClass}', 'MyTestMigration', $tpl);
        $parsed = str_replace('${migrationDate}', '20141006170535', $parsed);
        
        file_put_contents('/tmp/20141006170535-MyTestMigration.php', $parsed);
        
        return '/tmp/20141006170535-MyTestMigration.php';
    }
}
