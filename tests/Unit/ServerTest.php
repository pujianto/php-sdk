<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;


/**
 * 
 * @testdox Servers
 */
class ServerTest extends TestCase
{

    /**
     * 
     * @dataProvider serverListResponse
     */
    public function testServerList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->server->list('all')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverListResponse()
    {
        return [
            [
                [
                    [
                        "slug" => "string",
                        "name" => "string",
                        "date" => "string",
                        "location" => "string",
                        "image" => "string",
                        "profile" => "string",
                        "ipv4" => "string",
                        "ipv6" => "string",
                        "status" => "provisioning",
                        "virtualization" => "container",
                        "webServer" => "Apache",
                        "aliases" => [
                            "string"
                        ],
                        "snapshotRunTime" => 0,
                        "description" => "string",
                        "WordPressLockDown" => "false",
                        "SSHPasswordAuthEnabled" => "false",
                        "notes" => "string",
                        "nextActionDate" => "string"
                    ]
                ]
            ]
        ];
    }

    /**
     * 
     * @dataProvider serverCreateResponse
     */
    public function testServerCreate($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->server->create(
            [
                'name' => 'string',
                'slug' => 'string',
                'locationId' => 'string',
                'profileSlug' => 'string',

            ]
        )
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverCreateResponse()
    {
        return [
            [
                [
                    "slug" => "string",
                    "name" => "string",
                    "date" => "string",
                    "location" => "string",
                    "image" => "string",
                    "profile" => "string",
                    "ipv4" => "string",
                    "ipv6" => "string",
                    "status" => "provisioning",
                    "virtualization" => "container",
                    "webServer" => "Apache",
                    "aliases" => [
                        "string"
                    ],
                    "snapshotRunTime" => 0,
                    "description" => "string",
                    "WordPressLockDown" => "false",
                    "SSHPasswordAuthEnabled" => "false",
                    "notes" => "string",
                    "nextActionDate" => "string"
                ]
            ]
        ];
    }


    /**
     * 
     * @dataProvider serverGetResponse
     */
    public function testServerGet($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->server->get('server-slug')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverGetResponse()
    {
        return
            [
                [
                    [
                        "slug" => "string",
                        "name" => "string",
                        "date" => "string",
                        "location" => "string",
                        "image" => "string",
                        "profile" => "string",
                        "ipv4" => "string",
                        "ipv6" => "string",
                        "status" => "provisioning",
                        "virtualization" => "container",
                        "webServer" => "Apache",
                        "aliases" => [
                            "string"
                        ],
                        "snapshotRunTime" => 0,
                        "description" => "string",
                        "WordPressLockDown" => "false",
                        "SSHPasswordAuthEnabled" => "false",
                        "notes" => "string",
                        "nextActionDate" => "string"
                    ]
                ]
            ];
    }

    public function testServerDelete()
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], '')
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertEquals(202, $client->server->delete('server-slug')
            ->getStatusCode());
    }

    /**
     * 
     * @dataProvider serverUpdateResponse
     */
    public function testServerUpdate($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->server->update(
            'server-slug',
            [
                "name" => "string",
                "description" => "string",
                "notes" => "string",
                "nextActionDate" => "2023-09-29"
            ]
        )
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverUpdateResponse()
    {
        return
            [
                [
                    [
                        "slug" => "string",
                        "name" => "string",
                        "date" => "string",
                        "location" => "string",
                        "image" => "string",
                        "profile" => "string",
                        "ipv4" => "string",
                        "ipv6" => "string",
                        "status" => "provisioning",
                        "virtualization" => "container",
                        "webServer" => "Apache",
                        "aliases" => [
                            "string"
                        ],
                        "snapshotRunTime" => 0,
                        "description" => "string",
                        "WordPressLockDown" => "false",
                        "SSHPasswordAuthEnabled" => "false",
                        "notes" => "string",
                        "nextActionDate" => "string"
                    ]
                ]
            ];
    }
}
