<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Public Keys
 * 
 */
class PublicKeyTest extends TestCase
{

    /**
     * 
     * @dataProvider publicKeyListResponse
     */
    public function testPublicKeyList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->publicKey
            ->list()->getResponse()->toArray();

        $this->assertSame(
            $serverResponse,
            $response
        );
    }

    public function publicKeyListResponse()
    {
        return [
            [
                [
                    "id" => 0,
                    "name" => "string",
                    "key" => "string",
                    "created" => "string"
                ]
            ]

        ];
    }

    /**
     * 
     * @dataProvider publicKeyCreateResponse
     */
    public function testPublicKeyCreate($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(201, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->publicKey
            ->create([
                'name' => 'string',
                'publicKey' => 'string'
            ])
            ->getResponse()->toArray();

        $this->assertSame(
            $serverResponse,
            $response
        );
    }

    public function publicKeyCreateResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "name" => "string",
                        "key" => "string",
                        "created" => "string"
                    ]
                ]

            ];
    }

    public function testPublicKeyDelete()
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], '')
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertSame(200, $client->publicKey->delete(1)->getStatusCode());
    }
}
