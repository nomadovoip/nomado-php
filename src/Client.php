<?php

namespace nomado;

use nomado\Api\Account;
use nomado\Api\Calls;
use nomado\Api\Hlr;
use nomado\Api\Otp;
use nomado\Api\Sms;
use nomado\Common\Authentication;
use nomado\Common\Enswitch;
use nomado\Common\nomado;

/**
 * Class Client
 * @package nomado
 */
class Client
{
    /**
     * @var Sms
     */
    public $sms;
    /**
     * @var Otp
     */
    public $otp;
    /**
     * @var Hlr
     */
    public $hlr;
    /**
     * @var Calls
     */
    public $calls;
    /**
     * @var Account
     */
    public $account;

    public function __construct($credentials)
    {
        $authentication = new Authentication($credentials);
        $nomadoClient = new nomado($authentication);
        $enswitchClient = new Enswitch($authentication);

        $this->sms = new Sms($nomadoClient);
        $this->otp = new Otp($nomadoClient);
        $this->hlr = new Hlr($nomadoClient);
        $this->calls = new Calls($enswitchClient);
        $this->account = new Account($enswitchClient);
    }
}
