<?php

namespace NomadoTest\Api;
use Nomado\Api\Otp;
use NomadoTest\Common;

class OtpTest extends Common
{

    /**
     * @var Otp
     */
    public $otp;

    public function setUp()
    {
        $this->mockNomado();
        $this->otp = new Otp($this->httpClient);
        $this->httpClient->method('send')->willReturn((new \Nomado\Common\ResponseBuilder())->get());
    }

    public function testCreate()
    {
        $options = [
            'to' => 32456789101,
            'template' => 'Hello {{CODE}}'
        ];
        $expected = ['json' => array_merge([],$options)];
        $this->httpClient->expects($this->once())->method('send')->with('2fa/create', $expected, 'POST');
        $response = $this->otp->create($options);
        $this->assertEquals(200, $response->code);
    }

    public function testVerify()
    {
        $options = [
            'number' => 32456789101,
            'token' => '1234'
        ];
        $expected = ['json' => array_merge([],$options)];
        $this->httpClient->expects($this->once())->method('send')->with('2fa/verify', $expected, 'POST');
        $response = $this->otp->verify($options);
        $this->assertEquals(200, $response->code);
    }
}
