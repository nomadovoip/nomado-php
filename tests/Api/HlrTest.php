<?php

namespace NomadoTest\Api;
use NomadoTest\Common;
use Nomado\Api\Hlr;

class HlrTest extends Common
{
    /**
     * @var Hlr
     */
    public $hlr;

    public function setUp()
    {
        $this->mockNomado();
        $this->hlr = new Hlr($this->httpClient);
        $this->httpClient->method('send')->willReturn((new \Nomado\Common\ResponseBuilder())->get());
    }

    public function testFetch()
    {
        $options = [
            'numbers' => [32456789101]
        ];
        $expected = ['json' => array_merge([],$options)];
        $this->httpClient->expects($this->once())->method('send')->with('hlr/', $expected, 'POST');
        $response = $this->hlr->fetch($options);
        $this->assertEquals(200, $response->code);
    }

    public function testValidate()
    {
        $options = [
            'number' => 32456789101
        ];
        $expected = ['json' => array_merge([],$options)];
        $this->httpClient->expects($this->once())->method('send')->with('hlr/validate/32456789101', $expected, 'POST');
        $response = $this->hlr->validate($options);
        $this->assertEquals(200, $response->code);
    }
}
