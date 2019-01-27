<?php

namespace NomadoTest\Api;

use Nomado\Api\Account;
use Nomado\Api\Calls;
use Nomado\Api\Hlr;
use Nomado\Api\Otp;
use Nomado\Api\Sms;
use Nomado\Client;
use Nomado\Common\Authentication;
use Nomado\Common\Enswitch;
use Nomado\Common\Nomado;

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
