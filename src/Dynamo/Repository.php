<?php
namespace Dynamo;

use \Aws\Common\Enum\Region;
use \Aws\Common\Enum\ClientOptions;

use \Aws\DynamoDb\DynamoDbClient;

class Repository
{
    /**
     * @return \Aws\DynamoDb\DynamoDbClient
     */
    public function getDynamoDbClient()
    {
        $client = DynamoDbClient::factory([
            ClientOptions::PROFILE  => 'dynamo',
            ClientOptions::REGION   => Region::US_EAST_1,
            ClientOptions::BASE_URL => 'http://localhost:8000',
            'curl.options'          => [
                CURLOPT_ENCODING => ""
            ],
            'request.options' => [
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip;q=1.0,deflate;q=0.6,identity;q=0.3'
            ]
        ]);

        return $client;
    }
}
