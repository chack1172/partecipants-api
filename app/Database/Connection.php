<?php

namespace App\Database;

use App\Config;
use App\Database\Connection as DatabaseConnection;
use Error;
use Exception;
use PDO;
use PDOStatement;

class Connection extends PDO
{
    public function __construct()
    {
        // Instantiate sqlite database
        parent::__construct(
            'sqlite:' . Config::DB_PATH
        );
        // Throw exceptions on error
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
