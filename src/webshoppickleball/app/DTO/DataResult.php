<?php

namespace App\DTO;

class DataResult{
    public string $message;
    public int $http_code;
    public $data;

    public function __construct(string $message, int $http_code, $data = null)
    {
        $this->message = $message ?? null;
        $this->http_code = $http_code ?? null;
        $this->data = $data ?? null;
    }
}
