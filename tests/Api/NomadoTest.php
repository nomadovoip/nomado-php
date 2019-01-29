<?php

namespace nomadoTest\Api;

use nomado\Common\Authentication;
use nomado\Common\nomado;

class nomadoTest extends \PHPUnit_Framework_TestCase
{

    public function testCredentials()
    {
        $authentication = new Authentication(['username' => 'user', 'password' => 'pass']);
        $httpClient = $this->getMockBuilder(\GuzzleHttp\Client::class)
            ->setMethods(['send'])
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $options = array(
            'headers' => ['Authorization' => 'BASIC ' . base64_encode('user:pass')],
            'json' => ['key' => 'value']
        );

        $httpClient->expects($this->once())->method('send')->with($this->anything(), $options);

        $nomado = new nomado($authentication);
        $nomado->client = $httpClient;
        $nomado->post('/test', ['key' => 'value']);
    }
}
