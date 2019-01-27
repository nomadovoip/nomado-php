<?php

namespace NomadoTest;

use Nomado\Common\Authentication;
use PHPUnit\Framework\TestCase;

class Common extends TestCase
{
    protected $httpClient;

    public function mockNomado()
    {
        $this->mockHttpClient(\Nomado\Common\Nomado::class);
    }

    protected function mockHttpClient($class)
    {
        $authentication = new Authentication();
        $this->httpClient = $this->getMockBuilder($class)
            ->setMethods(['send'])
//            ->disableOriginalConstructor()
            ->setConstructorArgs([$authentication])
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
    }

    public function mockEnswitch()
    {
        $this->mockHttpClient(\Nomado\Common\Enswitch::class);
    }
}
