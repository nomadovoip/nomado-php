<?php

namespace Nomado\Common;

class ResponseBuilder
{
    protected $response;

    /**
     * ResponseBuilder constructor.
     */
    public function __construct($httpResponse = null)
    {
        $this->response = new Response();
        if ($httpResponse) {
            if ($httpResponse instanceof \GuzzleHttp\Psr7\Response) {
                $httpResponse = json_decode($httpResponse->getBody());
            }
            $this->withCode(empty($httpResponse->code) ? null : $httpResponse->code)
                ->withData(empty($httpResponse->data) ? [] : $httpResponse->data)
                ->withReason(empty($httpResponse->reason) ? '' : $httpResponse->reason);
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
        $this->response->data = $data;
        return $this;
    }

    public function get()
    {
        return $this->response;
    }
}
