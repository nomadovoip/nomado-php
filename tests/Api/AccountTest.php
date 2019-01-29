<?php

namespace nomadoTest\Api;

use nomado\Api\Account;
use nomadoTest\Common;

class AccountTest extends Common
{

    /**
     * @var Account
     */
    public $account;

    public function setUp()
    {
        $this->mockEnswitch();
        $this->account = new Account($this->httpClient);
    }

    protected function mockLogin() {
        $customerInfo = new \stdClass();
        $customerInfo->customer = 1;
        $this->httpClient->Authentication->setCustomer($customerInfo);
    }

    public function testGetBalance()
    {
        $this->mockLogin();
        $this->httpClient->method('send')->willReturn((new \nomado\Common\ResponseBuilder())->get());

        $expected = ['query' => ['id' => 1]];
        $this->httpClient->expects($this->once())->method('send')->with('customers/get/', $expected, 'GET');
        $response = $this->account->getBalance();
        $this->assertEquals(200, $response->code);
    }

    public function testLogin() {
        $customerInfo = new \stdClass();
        $customerInfo->customer = 1;

        $response = (new \nomado\Common\ResponseBuilder())
            ->withCode(200)
            ->withData($customerInfo)
            ->get();
        $this->httpClient->method('send')->willReturn($response);

        $this->account = new Account($this->httpClient);

        $response = $this->account->getBalance();
        $this->assertEquals(200, $response->code);
    }
}
