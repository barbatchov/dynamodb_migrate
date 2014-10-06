<?php
namespace Dynamo\Cli;

use \Dynamo\Cli\Migrate;

class MigrateTest extends \PHPUnit_Framework_TestCase
{
    const MIGRATE_FILE_CHANGELOG = '/tmp/migrate-test-changelog.log';
    const MIGRATE_FILE_PARSED = '/tmp/20141006170535-MyTestMigration.php';
    const MIGRATE_FILE_MOCKTPL = '/src/resources/MigrationMock.php.tpl';
    
    public function tearDown()
    {
        (file_exists(self::MIGRATE_FILE_CHANGELOG)) && 
            (unlink(self::MIGRATE_FILE_CHANGELOG));
    }

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
    
    /**
     * @group 1
     */
    public function testShouldCreateMigration()
    {
        
        $args = [
            'setChangelog' => self::MIGRATE_FILE_CHANGELOG,
            'setMigrationPath' => '/tmp/',
            'doMigration' => $this->createMigration(),
        ];
        
        $runnable = new Migrate();
        $runnable->run($args);
        
        $this->assertFileExists(self::MIGRATE_FILE_PARSED);
        $this->assertFileExists(self::MIGRATE_FILE_CHANGELOG);
        

        $runnable->run($args);
    }

    
    
    private function createMigration()
    {
        $tpl = file_get_contents(ROOT_DIR . self::MIGRATE_FILE_MOCKTPL);
        $parsed = str_replace('${migrationClass}', 'MyTestMigration', $tpl);
        $parsed = str_replace('${migrationDate}', '20141006170535', $parsed);
        
        file_put_contents(self::MIGRATE_FILE_PARSED, $parsed);
        
        return self::MIGRATE_FILE_PARSED;
    }
}
