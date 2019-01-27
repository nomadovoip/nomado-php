<?php

namespace NomadoTest\Api;

use Nomado\Api\Calls;
use NomadoTest\Common;

class CallsTest extends Common
{
    /**
     * @var Calls
     */
    public $calls;

    public function setUp()
    {
        $this->mockEnswitch();
        $this->calls = new Calls($this->httpClient);
        $this->httpClient->method('send')->willReturn((new \Nomado\Common\ResponseBuilder())->get());
    }

    public function testMake()
    {
        $options = [
            'cnumber' => 32456789101,
            'snumber' => 32456789101
        ];
        $expected = ['query' => array_merge([],$options)];
        $this->httpClient->expects($this->once())->method('send')->with('calls/make/', $expected, 'GET');
        $response = $this->calls->make($options);
        $this->assertEquals(200, $response->code);
    }
}
