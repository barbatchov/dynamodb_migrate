<?php
namespace Dynamo\Migrations;

use \Dynamo\MigrableAbstract;
use \Dynamo\MigrableException;

use \Aws\DynamoDb\Enum\KeyType;
use \Aws\DynamoDb\Enum\Type;

/**
 * This class was auto generated by migrate tool
 * If you want to see how proceed with DynamoDb, please follow the link:
 * http://docs.aws.amazon.com/amazondynamodb/latest/developerguide/WorkingWithTables.html
 */
class ${migrationClass}${migrationDate} extends MigrableAbstract
{
    public function doMigration()
    {
        /* @TODO Put your migration updates here */
        return;
    }

    public function undoMigration()
    {
        /* @TODO Put your migration undos here */
        return;
    }
}