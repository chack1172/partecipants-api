<?php

namespace App\Http;

class Response
{
    private int $code = 200;

    public function __construct()
    {
        //
    }

    public function status(int $code): Response
    {
        $this->code = $code;
        return $this;
    }

    public function send(string $data)
    {
        http_response_code($this->code);
        echo $data;
        die();
    }

    public function json($data)
    {
        header('Content-Type: application/json');
        $this->send(json_encode($data));
    }

    public function error(string $error, int $statusCode = 500)
    {
        $this->status($statusCode)->json([
            'error' => $error
        ]);
    }
}
