<?php


namespace Nomado\Common;


class Response
{
    public $code;
    public $message;
    public $reason;
    public $data;

    /**
     * Response constructor.
     * @param int $code
     * @param $message
     * @param $reason
     * @param array $data
     */
    public function __construct($code = 200, $message = '', $reason = null, array $data = [])
    {
        $this->code = $code;
        $this->message = $message;
        $this->reason = $reason;
        $this->data = $data;
    }
}
