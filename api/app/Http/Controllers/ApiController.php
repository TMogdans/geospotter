<?php

namespace App\Http\Controllers;


abstract class ApiController extends Controller
{
    private $headers;

    private $code = 200;

    private $status = [
        'code' => 200,
        'message' => 'ok'
    ];

    public function __construct()
    {
        $this->addHeader('Accept', 'application/json');
        $this->addHeader('Content-Type', 'application/json');
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setStatusCode($code)
    {
        $this->code = $code;
        $this->status['code'] = $code;
    }

    public function getStatusCode()
    {
        return $this->code;
    }

    public function respondNotFound()
    {
        $this->setStatusCode(404);
        $this->setMessage('Not Found');
        $response['status'] = $this->getStatus();

        return $this->respond($response);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setMessage($string)
    {
        $this->status['message'] = $string;
    }

    public function response($body)
    {
        $response['status'] = $this->getStatus();
        $response['body'] = $body;

        return $this->respond($response);
    }

    private function respond($payload)
    {
        return response(json_encode($payload), $this->getStatusCode())->withHeaders($this->getHeaders());
    }
}