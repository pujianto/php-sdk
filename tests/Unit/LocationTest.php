<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Possible server locations
 * 
 */
class LocationTest extends TestCase
{


    /**
     * 
     * @dataProvider locationListResponse
     */
    public function testLocationList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->location->list()
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function locationListResponse()
    {
        return [
            [
                [
                    "id" => "string",
                    "name" => "string",
                    "city" => "string",
                    "country" => "string",
                    "description" => "string",
                    "icon" => "string"
                ]
            ]
        ];
    }
}
