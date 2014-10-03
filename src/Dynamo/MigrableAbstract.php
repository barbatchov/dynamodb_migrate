<?php
namespace Dynamo;

use Aws\DynamoDb\DynamoDbClient;
use Dynamo\MigrableInterface;

abstract class MigrableAbstract implements MigrableInterface
{
    /** @var \Aws\DynamoDb\DynamoDbClient */
    protected $dynamoDbClient;

    public function __construct(\Aws\DynamoDb\DynamoDbClient $cli = null)
    {
        $this->setDynamoDbClient($cli);
    }

    /**
     * @param \Aws\DynamoDb\DynamoDbClient $cli
     * @return \Dynamo\MigrableAbstract
     */
    public function setDynamoDbClient(\Aws\DynamoDb\DynamoDbClient $cli = null)
    {
        $this->dynamoDbClient = $cli;
        return $this;
    }

    /**
     * @return \Aws\DynamoDb\DynamoDbClient
     */
    public function getDynamoDbClient()
    {
        return $this->dynamoDbClient;
    }
}
