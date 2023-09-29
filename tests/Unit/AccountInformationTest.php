<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Account Information Features
 * 
 */

class AccountInformationTest extends TestCase
{

    /**
     * 
     * @dataProvider accountInformationGetResponse
     */
    public function testAccountInformationGet($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $this->assertSame(
            $serverResponse,
            $client->accountInformation
                ->get()
                ->getResponse()
                ->toArray()
        );
    }

    public function accountInformationGetResponse()
    {
        return [
            [
                [
                    'userId' => 0,
                    'companyName' => 'string',
                    'userName' => 'string',
                    'userAvatar' => 'string',
                    'userEmail' => 'string',
                    'isTeamMember' => true,
                    'teamLeader' => 'string',
                    'accountBalance' => 'string',
                    'accountBalanceRaw' => 'string',
                    'accountBalanceRawCurrency' => 'string'
                ]
            ]
        ];
    }
}
