<?php

namespace Nomado;

use Nomado\Api\Sms;
use Nomado\Common\Authentication;
use Nomado\Common\Nomado;

/**
 * Class Client
 * @package Nomado
 */
class Client
{
    public $sms;
    public $otp;
    public $hlr;
    public $calls;
    public $account;

    public function __construct($credentials)
    {
        $authentication = new Authentication($credentials);
        $nomadoClient = new Nomado($authentication);

        $this->sms = new Sms($nomadoClient);
    }
}
