<?php

namespace nomado\Api;

class Account extends Api
{

    public function getBalance()
    {
        $endpoint = 'customers/get/';
        $options = $this->addUserId();

        $response = $this->_call($endpoint, 'get', $options);

        if (property_exists($response->data, "balance")) {
            // We only keep the 'balance' field
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
            $userId = $this->login();
        }
        $options['id'] = $userId;

        return $options;
    }

    protected function login()
    {
        $endpoint = 'user/login/';
        $response = $this->_call($endpoint, 'get');
        if (!empty($response->data->customer)) {
            $this->httpClient->Authentication->setCustomer($response->data);
            return $response->data->customer;
        } else {
            throw new \Exception('Login failed.');
        }

    }
}
