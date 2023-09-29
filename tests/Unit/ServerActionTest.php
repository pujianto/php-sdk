<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Server Actions
 * 
 */
class ServerActionTest extends TestCase
{

    public function testServerStart()
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
            $client->serverAction->start('server-slug')->getStatusCode()
        );
    }

    public function testServerStop()
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
            $client->serverAction->stop('server-slug')->getStatusCode()
        );
    }

    public function testServerReboot()
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
            $client->serverAction->reboot('server-slug')->getStatusCode()
        );
    }

    public function testServerSuspend()
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
            $client->serverAction->suspend('server-slug')->getStatusCode()
        );
    }

    public function testServerReinstall()
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
            $client->serverAction->reinstall('server-slug', 'ubuntu')->getStatusCode()
        );
    }

    /**
     * 
     * @dataProvider serverSnapshotResponse
     */
    public function testServerSnapshot($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(202, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverAction->snapshot('server-slug', 'snapshot-name')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function serverSnapshotResponse()
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

    public function testServerRestore()
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
            $client->serverAction->restore('server-slug', 123)->getStatusCode()
        );
    }

    public function testServerResize()
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
            $client->serverAction->resize('server-slug', 'profile-slug')->getStatusCode()
        );
    }

    public function testDryRunServerResize()
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
            $client->serverAction->dryRunResize('server-slug', 'profile-slug')->getStatusCode()
        );
    }
}
