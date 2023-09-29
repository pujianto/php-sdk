<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Server Scripts & Files
 * 
 */
class ServerScriptTest extends TestCase
{

    /**
     * 
     * @dataProvider serverScriptListResponse
     */
    public function testServerScriptList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverScript->list('server-slug')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverScriptListResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "name" => "string",
                        "path" => "string",
                        "lastRun" => "string",
                        "lastRunCallbackId" => "string",
                        "created" => "string"
                    ]
                ]

            ];
    }

    /**
     * 
     * @dataProvider serverScriptCreateResponse
     */
    public function testServerScriptCreate($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverScript->create('server-slug', [
            'scriptId' => 123,
            'path' => 'string'
        ])->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverScriptCreateResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "name" => "string",
                        "path" => "string",
                        "lastRun" => "string",
                        "lastRunCallbackId" => "string",
                        "created" => "string"
                    ]
                ]
            ];
    }

    /**
     * 
     * @dataProvider serverScriptGetResponse
     */
    public function testServerScriptGet($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverScript->get('server-slug', 0)
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverScriptGetResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "name" => "string",
                        "path" => "string",
                        "lastRun" => "string",
                        "lastRunCallbackId" => "string",
                        "created" => "string"
                    ]
                ]
            ];
    }

    public function testServerScriptDelete()
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], '')
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertSame(
            202,
            $client->serverScript->delete('server-slug', 0)->getStatusCode()
        );
    }

    public function testServerScriptExecute()
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], '')
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertSame(
            202,
            $client->serverScript->executeScript('server-slug', 0)->getStatusCode()
        );
    }

    public function testServerScriptFetch()
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], '')
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertSame(
            202,
            $client->serverScript->fetchFile('server-slug', 'file-path')->getStatusCode()
        );
    }
}
