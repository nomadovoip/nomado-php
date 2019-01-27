<?php

namespace Nomado\Common;


class Enswitch extends AbstractHttpClient
{
    const SERVER_URL = 'https://npbx.nomado.eu/api/json/';
    protected $headers;

    public function __construct(Authentication $Authentication)
    {
        parent::__construct(self::SERVER_URL, $Authentication);
    }

    /**
     * @param $options
     * @return array
     */
    protected function addCredentials($options)
    {
        $credentials = $this->Authentication->getCredentials();
        $options['query']['auth_username'] = $credentials['username'];
        $options['query']['auth_password'] = $credentials['password'];
        return $options;
    }

    protected function formatResponse(\GuzzleHttp\Psr7\Response $httpResponse) {
        $responseBody = json_decode($httpResponse->getBody());
        $formattedResponse = new \stdClass();

        if (!empty($responseBody->responses)) {
            $formattedResponse = is_array($responseBody->responses) ? $responseBody->responses[0] : $responseBody;
            if (!empty($formattedResponse->message)) {
                $formattedResponse->reason = $formattedResponse->message;
            }
        }
        if (!empty($responseBody->data)) {
            $formattedResponse->data = $responseBody->data;
        }
        return $formattedResponse;
    }

    /**
     * @param $endpoint
     * @param array $options
     * @param string $method
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($endpoint, $options = [], $method = 'GET')
    {
        try {
            $request = $this->makeRequest($method, $endpoint);
            $options = $this->addCredentials($options);
            $httpResponse = $this->client->send($request, $options);
            $formattedResponse = $this->formatResponse($httpResponse);
            return $this->responseBuilder($formattedResponse)->get();
        } catch (\Exception $ex) {
            return $this->responseBuilder()
                ->withCode(400)
                ->withReason($ex->getMessage())
                ->get();
        }
    }
}
