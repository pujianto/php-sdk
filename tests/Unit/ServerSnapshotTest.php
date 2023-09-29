<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Server Snapshots
 * 
 */
class ServerSnapshotTest extends TestCase
{

    /**
     * 
     * @dataProvider serverSnapshotListResponse
     */
    public function testServerSnapshotList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverSnapshot->list('server-slug')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverSnapshotListResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "name" => "string",
                        "date" => "string",
                        "type" => "daily",
                        "virtualization" => "container",
                        "completed" => "false",
                        "deletable" => "false"
                    ]
                ]
            ];
    }

    /**
     * 
     * @dataProvider serverSnapshotGetResponse
     */
    public function testServerSnapshotGet($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverSnapshot->get('server-slug', 1)
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverSnapshotGetResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "name" => "string",
                        "date" => "string",
                        "type" => "daily",
                        "virtualization" => "container",
                        "completed" => "false",
                        "deletable" => "false"
                    ]
                ]
            ];
    }

    public function testServerSnapshotDelete()
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], '')
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertEquals(202, $client->serverSnapshot->delete('server-slug', 1)
            ->getStatusCode());
    }


    /** 
     * 
     * @dataProvider serverSnapshotCreateResponse
     */
    public function testServerSnapshotCreate($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverSnapshot->create('server-slug', 'snapshot-name')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverSnapshotCreateResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "name" => "string",
                        "date" => "string",
                        "type" => "daily",
                        "virtualization" => "container",
                        "completed" => "false",
                        "deletable" => "false"
                    ]
                ]

            ];
    }
}
