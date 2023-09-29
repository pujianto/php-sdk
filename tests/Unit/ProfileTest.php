<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdix Possible server profiles
 * 
 */
class ProfileTest extends TestCase
{

    /**
     * 
     * @dataProvider profileListResponse 
     */
    public function testProfileList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );


        $response = $client->profile->list('europe')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function profileListResponse()
    {
        return
            [
                [
                    [
                        "slug" => "string",
                        "name" => "string",
                        "ram" => 0,
                        "disk" => 0,
                        "cpu" => [
                            "cores" => 0,
                            "threads" => 0
                        ],
                        "price" => [
                            "amount" => 0,
                            "currency" => "EUR"
                        ]
                    ]
                ]

            ];
    }
}
