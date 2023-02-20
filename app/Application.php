<?php

namespace App;

use App\Database\Connection;
use App\Http\Response;

/**
 * @property-read Connection $db
 * @property-read Response $response
 */
class Application
{
    private Connection $db;

    private Response $response;

    public function __construct()
    {
        $this->db = new Connection();
        $this->response = new Response();
    }

    /**
     * @param string[] ...$methods
     * @return void
     */
    public function allowedMethods(array|string $methods)
    {
        $methods = !is_array($methods) ? func_get_args() : $methods;
        $currentMethod = $_SERVER['REQUEST_METHOD'];
        if (!in_array($currentMethod, $methods)) {
            $this->response->error($currentMethod . ' method is not allowed on this route.');
        }
    }

    public function __get(string $variable)
    {
        if (in_array($variable, ['db', 'response'])) {
            return $this->$variable;
        }
    }
}
