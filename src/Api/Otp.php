<?php

namespace nomado\Api;

use nomado\Common\Response;

class Otp extends Api
{

    /**
     * @param $options
     * @return Response
     */
    public function create($options) {
        $endpoint = '2fa/create';
        $requiredParams = ['to'];

        return $this->_call($endpoint, 'post', $options, $requiredParams);
    }

    /**
     * @param $options
     * @return Response
     */
    public function verify($options) {
        $endpoint = '2fa/verify';
        $requiredParams = ['number', 'token'];

        return $this->_call($endpoint, 'post', $options, $requiredParams);
    }

}
