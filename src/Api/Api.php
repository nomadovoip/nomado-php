<?php

namespace nomado\Api;

use nomado\Common\AbstractHttpClient;
use nomado\Traits\ResponseTrait;

class Api
{
    use ResponseTrait;
    /**
     * @var AbstractHttpClient
     */
    protected $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param $endpoint
     * @param $options
     * @param array $requiredParams
     * @param string $method
     * @return \nomado\Common\Response
     */
    protected function _call($endpoint, $method = 'post', $options = null, $requiredParams = null)
    {
        $missingParams = $this->_missing($options, $requiredParams);
        if ($missingParams) {
            return $this->responseBuilder()
                ->withCode(400)
                ->withReason('Some required options are missing : ' . implode(',', $missingParams))
                ->get();
        }

        return $this->httpClient->{$method}($endpoint, $options);
    }

    protected function _missing($options, $requiredParams = null)
    {
        if ($requiredParams) {
            return array_filter($requiredParams, function ($key) use ($options) {
                return !isset($options[$key]);
            });
        }
        return null;
    }
}
