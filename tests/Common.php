<?php

namespace nomadoTest;

use nomado\Common\Authentication;
use PHPUnit\Framework\TestCase;

class Common extends TestCase
{
    protected $httpClient;

    public function mocknomado()
    {
        $this->mockHttpClient(\nomado\Common\nomado::class);
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
        $this->mockHttpClient(\nomado\Common\Enswitch::class);
    }
}
