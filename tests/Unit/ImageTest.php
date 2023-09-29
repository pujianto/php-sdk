<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Possible server images
 * 
 */
class ImageTest extends TestCase
{

    /**
     * 
     * @dataProvider imageListResponse
     */
    public function testImageList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->image->list()
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function imageListResponse()
    {
        return [
            [
                [
                    "slug" => "string",
                    "name" => "string",
                    "webServer" => null,
                    "phpVersion" => "string"
                ]
            ]
        ];
    }
}
