<?php

namespace Nomado\Api;

use Nomado\Common\AbstractHttpClient;
use Nomado\Traits\ResponseTrait;

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

    protected function _missing($options, $requiredParams = null)
    {
        if ($requiredParams) {
            return array_filter($requiredParams, function ($key) use ($options) {
                return !isset($options[$key]);
            });
        }
        return null;
    }

    /**
     * @param $endpoint
     * @param $options
     * @param array $requiredParams
     * @param string $method
     * @return \Nomado\Common\Response
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

        try {
            return $this->httpClient->{$method}($endpoint, $options);
        } catch(\Exception $ex) {
            return $this->responseBuilder()
                ->withCode(400)
                ->withReason($ex->getMessage())
                ->get();
        }
    }
}
