<?php


namespace nomado\Api;

use nomado\Common\Response;

class Hlr extends Api
{

    /**
     * @param $options
     * @return Response
     */
    public function fetch($options) {
        $endpoint = 'hlr/';
        $requiredParams = ['numbers'];

        // numbers need to be an array of numbers
        $options['numbers'] = (array)$options['numbers'];

        return $this->_call($endpoint, 'post', $options, $requiredParams);
    }

    /**
     * @param $options
     * @return Response
     */
    public function validate($options) {
        $endpoint = 'hlr/validate/';
        $requiredParams = ['number'];

        return $this->_call($endpoint . $options['number'], 'post', $options, $requiredParams);
    }

}
