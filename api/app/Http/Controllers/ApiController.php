<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use JsonException;
use Laravel\Lumen\Http\ResponseFactory;

abstract class ApiController extends Controller
{
    private array $headers = [];

    private int $code = 200;

    private array $status = [
        'code' => 200,
        'message' => 'ok'
    ];

    public function __construct()
    {
        $this->addHeader('Accept', 'application/json');
        $this->addHeader('Content-Type', 'application/json');
    }

    public function addHeader($key, $value): void
    {
        $this->headers[$key] = $value;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setStatusCode($code): void
    {
        $this->code = $code;
        $this->status['code'] = $code;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @throws JsonException
     */
    public function response($body): Response|ResponseFactory
    {
        $response['status'] = $this->getStatus();
        $response['body'] = $body;

        return $this->respond($response);
    }

    /**
     * @throws JsonException
     */
    private function respond($payload): Response|ResponseFactory
    {
        return response(
            json_encode($payload, JSON_THROW_ON_ERROR),
            $this->getStatusCode()
        )->withHeaders($this->getHeaders());
    }
}
