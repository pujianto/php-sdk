<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;


/**
 * 
 * @testdox Event Poll
 * 
 */

class EventPollTest extends TestCase
{

    /**
     * 
     * @dataProvider eventPollListResponse
     */
    public function testEventPollList($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $params = [
            'callbackId' => 'the-callback-id',
            'eventType' => 'string',

        ];
        $response = $client->eventPoll->list($params)
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function eventPollListResponse()
    {
        return [
            [
                [
                    "id" => 0,
                    "startTime" => "string",
                    "endTime" => "string",
                    "callbackId" => "string",
                    "serverSlug" => "string",
                    "eventType" => "string",
                    "action" => "string",
                    "actionData" => "string",
                    "status" => "waiting",
                    "message" => "string"
                ]
            ]
        ];
    }
}
