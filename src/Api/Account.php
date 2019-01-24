<?php

namespace Nomado\Api;

use Nomado\Common\Response;

class Account extends Api
{
    /**
     * @param $options
     * @return Response
     */
    public function getBalance()
    {
        $endpoint = 'customers/get';
        $options = $this->addUserId();

        $response = $this->_call($endpoint, 'get', $options);
        // We only keep the 'balance' field
        if (property_exists($response->data, "balance")) {
            $balance = $response->data->balance;
            $response->data = new \stdClass();
            $response->data->balance = $balance;
        }

        return $response;
    }

    protected function addUserId($options = [])
    {
        $userId = $this->httpClient->Authentication->getCustomerId();
        if (!$userId) {
            $this->login();
            $userId = $this->httpClient->Authentication->getCustomerId();
        }
        $options['id'] = $userId;

        return $options;
    }

    protected function login()
    {
        $endpoint = 'user/login';
        $response = $this->_call($endpoint, 'get');

        if (!empty($response->data->customer)) {
            $this->httpClient->Authentication->setCustomer($response->data);
        } else {
            throw new \Exception('Login failed.');
        }

    }
}
