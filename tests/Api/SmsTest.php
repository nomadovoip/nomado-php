<?php
namespace nomadoTest\Api;

use nomado\Api\Sms;
use nomadoTest\Common;

class SmsTest extends Common
{

    /**
     * @var Sms
     */
    public $sms;

    public function setUp()
    {
        $this->mocknomado();
        $this->sms = new Sms($this->httpClient);
        $this->httpClient->method('send')->willReturn((new \nomado\Common\ResponseBuilder())->get());
    }

    public function testSend()
    {
        $options = [
            'to' => [32456789101],
            'message' => 'Hello'
        ];
        $expected = ['json' => array_merge(['unicode' => false],$options)];
        $this->httpClient->expects($this->once())->method('send')->with('sms/send', $expected, 'POST');

        $response = $this->sms->send($options);
        $this->assertEquals(200, $response->code);
    }
}
