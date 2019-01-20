<?php

namespace Nomado\Common;

class ResponseBuilder
{
    protected $response;

    public function __construct(\GuzzleHttp\Psr7\Response $httpResponse = null)
    {
        $this->response = new Response();
        if ($httpResponse) {
            $this->withCode($httpResponse->getStatusCode())
                ->withData($httpResponse->getBody())
                ->withReason($httpResponse->getReasonPhrase());
        }
    }

    /**
     * @param $code
     * @return ResponseBuilder
     */
    public function withCode($code)
    {
        $this->response->code = $code;
        return $this;
    }

    /**
     * @param mixed $message
     * @return ResponseBuilder
     */
    public function withMessage($message)
    {
        $this->response->message = $message;
        return $this;
    }

    /**
     * @param mixed $reason
     * @return ResponseBuilder
     */
    public function withReason($reason)
    {
        $this->response->reason = $reason;
        return $this;
    }

    /**
     * @param string $data
     * @return ResponseBuilder
     */
    public function withData($data)
    {
        $this->response->data = json_decode($data, true);
        return $this;
    }

    public function get()
    {
        return $this->response;
    }
}
