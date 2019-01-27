<?php

namespace NomadoTest\Api;

use Nomado\Common\Authentication;
use Nomado\Common\Nomado;

class NomadoTest extends \PHPUnit_Framework_TestCase
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

        $Nomado = new Nomado($authentication);
        $Nomado->client = $httpClient;
        $Nomado->post('/test', ['key' => 'value']);
    }
}
