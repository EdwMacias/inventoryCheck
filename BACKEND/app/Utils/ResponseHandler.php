<?php

namespace App\Utils;
use Throwable;

class ResponseHandler 
{
    protected $message = [''];
    protected $data;
    protected $status;

    public function __construct($message = '', $data = [], int $status = 200)
    {
        $this->message = $message;
        $this->data = $data;
        $this->status = $status;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function responses()
    {
        return response()->json([
            'messages' => $this->message,
            'data' => $this->data,
            'code' => $this->status,
        ], $this->status);
    }
   
}
