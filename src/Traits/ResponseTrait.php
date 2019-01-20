<?php

namespace Nomado\Traits;
use GuzzleHttp\Psr7\Response;
use Nomado\Common\ResponseBuilder;

trait ResponseTrait {
    /**
     * @param Response $response
     * @return ResponseBuilder
     */
    protected function responseBuilder($response = null) {
        return new ResponseBuilder($response);
    }
}
