<?php

namespace Nomado;

use Nomado\Api\Calls;
use Nomado\Api\Hlr;
use Nomado\Api\Otp;
use Nomado\Api\Sms;
use Nomado\Common\Authentication;
use Nomado\Common\Enswitch;
use Nomado\Common\Nomado;

/**
 * Class Client
 * @package Nomado
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
     * @var
     */
    public $account;

    public function __construct($credentials)
    {
        $authentication = new Authentication($credentials);
        $nomadoClient = new Nomado($authentication);
        $enswitchClient = new Enswitch($authentication);

        $this->sms = new Sms($nomadoClient);
        $this->otp = new Otp($nomadoClient);
        $this->hlr = new Hlr($nomadoClient);
        $this->calls = new Calls($enswitchClient);
    }
}
