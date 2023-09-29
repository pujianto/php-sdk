<?php

namespace Webdock\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webdock\Client as WebdockClient;
use GuzzleHttp\Psr7\Response;
use Webdock\Tests\Helper;

/**
 * 
 * @testdox Server Metrics
 * 
 */
class ServerMetricTest extends TestCase
{

    /**
     * 
     * @dataProvider getMetricsResponse
     */
    public function testGetMetrics($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverMetric->getMetrics('server-slug')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);
    }

    public function getMetricsResponse()
    {
        return
            [
                [
                    [
                        "disk" => [
                            "allowed" => 0,
                            "samplings" => [
                                [
                                    "amount" => 0,
                                    "timestamp" => "string"
                                ]
                            ]
                        ],
                        "network" => [
                            "total" => 0,
                            "allowed" => 0,
                            "ingressSamplings" => [
                                [
                                    "amount" => 0,
                                    "timestamp" => "string"
                                ]
                            ],
                            "egressSamplings" => [
                                [
                                    "amount" => 0,
                                    "timestamp" => "string"
                                ]
                            ]
                        ],
                        "cpu" => [
                            "usageSamplings" => [
                                [
                                    "amount" => 0,
                                    "timestamp" => "string"
                                ]
                            ]
                        ],
                        "processes" => [
                            "processesSamplings" => [
                                [
                                    "amount" => 0,
                                    "timestamp" => "string"
                                ]
                            ]
                        ],
                        "memory" => [
                            "usageSamplings" => [
                                [
                                    "amount" => 0,
                                    "timestamp" => "string"
                                ]
                            ]
                        ]
                    ]
                ]

            ];
    }

    /**
     * 
     * @dataProvider instantMetricsResponse
     */
    public function testGetInstantMetrics($serverResponse)
    {
        $handler = Helper::createMockHandler([
            new Response(200, [], json_encode($serverResponse))
        ]);

        $client = new WebdockClient(
            Helper::token(),
            Helper::appName(),
            $handler
        );

        $response = $client->serverMetric->getMetricsNow('server-slug')
            ->getResponse()->toArray();

        $this->assertSame($serverResponse, $response);

    }

    public function instantMetricsResponse()
    {
        return
            [
                [
                    [
                        "disk" => [
                            "allowed" => 0,
                            "lastSamplings" => [
                                "amount" => 0,
                                "timestamp" => "string"
                            ]
                        ],
                        "network" => [
                            "total" => 0,
                            "allowed" => 0,
                            "latestIngressSampling" => [
                                "amount" => 0,
                                "timestamp" => "string"
                            ],
                            "latestEgressSampling" => [
                                "amount" => 0,
                                "timestamp" => "string"
                            ]
                        ],
                        "cpu" => [
                            "latestUsageSampling" => [
                                "amount" => 0,
                                "timestamp" => "string"
                            ]
                        ],
                        "processes" => [
                            "latestProcessesSampling" => [
                                "amount" => 0,
                                "timestamp" => "string"
                            ]
                        ],
                        "memory" => [
                            "latestUsageSampling" => [
                                "amount" => 0,
                                "timestamp" => "string"
                            ]
                        ]
                    ]
                ]
            ];
    }
}
