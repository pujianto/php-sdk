<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Script Library
 * 
 */
class ScriptTest extends TestCase
{

    /**
     * 
     * @dataProvider scriptListResponse
     */
    public function testScriptList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->script
            ->list()->getResponse()->toArray();

        $this->assertSame(
            $serverResponse,
            $response
        );
    }

    public function scriptListResponse()
    {
        return
            [

                [
                    [
                        "id" => 0,
                        "name" => "string",
                        "description" => "string",
                        "filename" => "string",
                        "content" => "string"
                    ]
                ]
            ];
    }
}
