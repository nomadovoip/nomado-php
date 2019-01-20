<?php

namespace Nomado\Api;

use Nomado\Common\Response;

class Sms extends Api
{
    /**
     * @param $options
     * @return Response
     */
    public function send($options) {
        $endpoint = 'sms/send';
        $requiredParams = ['to', 'message'];
        // Default value for unicode
        $options = array_merge(['unicode' => false], $options);

        return $this->_call($endpoint, 'post', $options, $requiredParams);
    }
}
