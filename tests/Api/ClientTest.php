<?php

namespace nomadoTest\Api;

use nomado\Api\Account;
use nomado\Api\Calls;
use nomado\Api\Hlr;
use nomado\Api\Otp;
use nomado\Api\Sms;
use nomado\Client;
use nomado\Common\Authentication;
use nomado\Common\Enswitch;
use nomado\Common\nomado;

class ClientTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $Client = new Client([]);
        $this->assertInstanceOf(Sms::class, $Client->sms);
        $this->assertInstanceOf(Otp::class, $Client->otp);
        $this->assertInstanceOf(Hlr::class, $Client->hlr);
        $this->assertInstanceOf(Calls::class, $Client->calls);
        $this->assertInstanceOf(Account::class, $Client->account);
    }
}
