<?php

namespace Nomado\Common;

use GuzzleHttp\Psr7\Request;
use Nomado\Traits\ResponseTrait;

abstract class AbstractHttpClient
{
    use ResponseTrait;

    /**
     * @var \GuzzleHttp\Client
     */
    public $client;
    /**
     * @var Authentication
     */
    public $Authentication;
    protected $serverUrl;

    public function __construct($serverUrl, Authentication $Authentication)
    {
        $this->serverUrl = $serverUrl;
        $this->Authentication = $Authentication;

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $serverUrl,
            'http_errors' => false
        ]);
    }

    /**
     * @param $method
     * @param $endpoint
     * @param null $headers
     * @return Request
     */
    protected function makeRequest($method, $endpoint) {
        return new Request($method, $this->serverUrl . '/' . $endpoint);
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return mixed
     */
    public function get($endpoint, $params = null)
    {
        return $this->send($endpoint, ['query' => $params], 'GET');
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return mixed
     */
    public function post($endpoint, $params = null)
    {
        return $this->send($endpoint, ['json' => $params], 'POST');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    abstract protected function send($request, $options);
}
