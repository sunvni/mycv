<?php
namespace Core\Lib;

use Core\Lib\Config;

class Database
{
    public function __construct()
    {
        $host = config()->database->host;
    }
}
