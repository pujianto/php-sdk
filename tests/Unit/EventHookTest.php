<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Event Hook
 * 
 */

class EventHookTest extends TestCase
{

    /**
     * 
     * @dataProvider eventHookListResponse
     */
    public function testEventHookList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->eventHook
            ->list()->getResponse()->toArray();

        $this->assertSame(
            $serverResponse,
            $response
        );
    }

    public function eventHookListResponse()
    {
        return [
            [
                [
                    "id" => 0,
                    "callbackUrl" => "string",
                    "filters" => [
                        [
                            "type" => "string",
                            "value" => "string"
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * 
     * @dataProvider eventHookCreateResponse
     */
    public function testEventHookCreate($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(201, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response =  $client->eventHook->create([
            "callbackUrl" => "http://example.com",
            "callbackId" => "string",
            "eventType" => "provision"
        ])->getResponse()->toArray();

        $this->assertSame(
            $serverResponse,
            $response
        );
    }

    public function eventHookCreateResponse()
    {
        return [
            [
                [
                    "id" => 0,
                    "callbackUrl" => "http://example.com",
                    "filters" => [
                        [
                            "type" => "provision",
                            "value" => "string"
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * 
     * @dataProvider eventHookGetResponse
     */
    public function testEventHookGet($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertSame(
            $serverResponse,
            $client->eventHook->get('0')
                ->getResponse()->toArray()
        );
    }

    public function eventHookGetResponse()
    {
        return [
            [
                [
                    "id" => 0,
                    "callbackUrl" => "string",
                    "filters" => [
                        [
                            "type" => "string",
                            "value" => "string"
                        ]
                    ]
                ]
            ]
        ];
    }


    public function testEventHookDelete()
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], '')
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertSame(200, $client->eventHook->delete(0)->getStatusCode());
    }
}
