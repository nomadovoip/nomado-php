<?php

namespace nomado\Common;


class nomado extends AbstractHttpClient
{
    const SERVER_URL = 'https://api.nomado.eu';
    protected $headers;

    public function __construct(Authentication $Authentication)
    {
        parent::__construct(self::SERVER_URL, $Authentication);

        $this->headers = ['Authorization' => $this->Authentication->getHeader()];
    }

    /**
     * @param $endpoint
     * @param array $options
     * @param string $method
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($endpoint, $options = [], $method = 'POST')
    {
        try {
            $request = $this->makeRequest($method, $endpoint);
            $options = array_merge(['headers' => $this->headers], $options);
            $response = $this->client->send($request, $options);
            return $this->responseBuilder($response)->get();
        } catch(\Exception $ex) {
            return $this->responseBuilder()
                ->withCode(400)
                ->withReason($ex->getMessage())
                ->get();
        }
    }
}
