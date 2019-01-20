<?php

use PHPUnit\Framework\TestCase;
use Nomado\Api\Sms;

class SmsTest extends TestCase
{

    /**
     * @var Sms
     */
    public $sms;

    public function setUp()
    {
        $httpClient = $this->getMockBuilder(\Nomado\Common\Nomado::class)
            ->setMethods(['send'])
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $response = (new \Nomado\Common\ResponseBuilder())->get();

        $httpClient->method('send')
            ->willReturn($response);

        $this->sms = new Sms($httpClient);
    }

    public function testSend()
    {
        $response = $this->sms->send([
            'to' => [32494808060],
            'message' => 'Hello'
        ]);

        $this->assertEquals(200, $response->code);
    }
}
