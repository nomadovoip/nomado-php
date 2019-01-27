<?php

namespace NomadoTest\Api;

use Nomado\Common\Authentication;
use Nomado\Common\Enswitch;

class EnswitchTest extends \PHPUnit_Framework_TestCase
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
            'query' => [
                'auth_username' => 'user',
                'auth_password' => 'pass'
            ]
        );

        $httpClient->expects($this->once())->method('send')->with($this->anything(), $options);

        $Enswitch = new Enswitch($authentication);
        $Enswitch->client = $httpClient;
        $Enswitch->get('/test');
    }
}
