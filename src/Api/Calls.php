<?php


namespace nomado\Api;

use nomado\Common\Response;

class Calls extends Api
{
    /**
     * @param $options
     * @return Response
     */
    public function make($options) {
        $endpoint = 'calls/make/';
        $requiredParams = ['snumber', 'cnumber'];

        return $this->_call($endpoint, 'get', $options, $requiredParams);
    }
}
