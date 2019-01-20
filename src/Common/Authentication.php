<?php


namespace Nomado\Common;


class Authentication
{
    protected $authType = 'BASIC';
    protected $credentials = [
        'username' => '',
        'password' => ''
    ];
    protected $token;
    protected $jwt;

    public function __construct($options = array())
    {
        if ($options) {
            $this->parseOptions($options);
        }
    }

    protected function parseOptions($options) {
        if (isset($options['auth_type'])) {
            if (!in_array($options['auth_type'], ['BASIC'])) {
                throw new \Exception($options['auth_type'] .' auth type not implemented.');
            }
            $this->authType = $options['auth_type'];
        }

        if (isset($options['username'])) {
            $this->credentials['username'] = $options['username'];
        }
        if (isset($options['password'])) {
            $this->credentials['password'] = $options['password'];
        }
        if (isset($options['token'])) {
            $this->token = $options['token'];
        }
    }

    /**
     * @return string
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * @return array
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getHeader() {
        switch($this->authType) {
            case 'BASIC' :
                return 'BASIC ' . base64_encode($this->credentials['username'] . ':' . $this->credentials['password']);
                break;
            case 'JWT' :
                return 'JWT ' .$this->jwt;
                break;
            case 'TOKEN' :
                return 'BEARER ' . $this->token;
                break;
        }
    }
}
