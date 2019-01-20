<?php

namespace Nomado\Common;


class Nomado extends AbstractHttpClient
{
    const SERVER_URL = 'https://api.nomado.eu';
    protected $headers;

    public function __construct(Authentication $Authentication)
    {
        parent::__construct(self::SERVER_URL, $Authentication);

        $this->headers = ['Authorization' => $this->Authentication->getHeader()];
    }

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($request, $options = [])
    {
        try {
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
