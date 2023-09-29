<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Shell Users
 * 
 */
class ServerShellUserTest extends TestCase
{

    /**
     * 
     * @dataProvider serverShellUserListResponse
     */
    public function testServerShellUserList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverShellUser
            ->list('server-slug')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverShellUserListResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "username" => "string",
                        "group" => "string",
                        "shell" => "string",
                        "publicKeys" => [
                            [
                                "id" => 0,
                                "name" => "string",
                                "key" => "string",
                                "created" => "string"
                            ]
                        ],
                        "created" => "string"
                    ]
                ]

            ];
    }

    /**
     * 
     * @dataProvider serverShellUserCreateResponse
     */
    public function testServerShellUserCreate($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client
            ->serverShellUser
            ->create('server-slug', [
                'username' => 'string',
                'password' => 'string',
                'group' => 'sudo',
                'shell' => '/bin/bash'
            ])
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverShellUserCreateResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "username" => "string",
                        "group" => "string",
                        "shell" => "string",
                        "publicKeys" => [
                            [
                                "id" => 0,
                                "name" => "string",
                                "key" => "string",
                                "created" => "string"
                            ]
                        ],
                        "created" => "string"
                    ]
                ]
            ];
    }

    public function testServerShellUserDelete()
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], '')
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertSame(202, $client->serverShellUser->delete('server-slug', 1)->getStatusCode());
    }

    /**
     * 
     * @dataProvider serverShellUserUpdateResponse
     */
    public function testServerShellUserUpdate($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverShellUser
            ->update(
                'server-slug',
                1,
                ["publicKeys" => [0]]
            )
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverShellUserUpdateResponse()
    {
        return
            [
                [
                    [
                        "id" => 0,
                        "username" => "string",
                        "group" => "string",
                        "shell" => "string",
                        "publicKeys" => [
                            [
                                "id" => 0,
                                "name" => "string",
                                "key" => "string",
                                "created" => "string"
                            ]
                        ],
                        "created" => "string"
                    ]
                ]

            ];
    }
}
