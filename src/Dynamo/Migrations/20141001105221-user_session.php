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
class UserSession20141001105221 extends MigrableAbstract
{
    public function doMigration()
    {
        $table =
        [
            "TableName"              => 'user_session',

            "AttributeDefinitions"   => [
                [
                    "AttributeName"  => "id_user_session",
                    "AttributeType"  => Type::STRING
                ],
                [
                    "AttributeName"  => "key",
                    "AttributeType"  => Type::STRING
                ]
            ],

            "KeySchema"              => [
                [
                    "AttributeName"  => "id_user_session",
                    "KeyType"        => KeyType::HASH,
                ],
                [
                    "AttributeName"  => "key",
                    "KeyType"        => KeyType::RANGE,
                ]
            ],

            "ProvisionedThroughput"  => [
                /*
                 * The number of strongly consistent reads per second of items
                 * up to 4 KB in size per second
                 */
                "ReadCapacityUnits"  => 5,
                /*
                 * The number of 1 KB writes per second
                 */
                "WriteCapacityUnits" => 6
            ]
        ];

        $this->getDynamoDbClient()->createTable($table);
    }

    public function undoMigration()
    {
        $this->getDynamoDbClient()->deleteTable(["TableName" => 'user_session']);
        $this->getDynamoDbClient()->waitUntilTableNotExists(["TableName" => 'user_session']);
    }
}
