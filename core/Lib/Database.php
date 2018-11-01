<?php
namespace Core\Lib;

use Core\Lib\Config;

class Database extends MRObject
{
    public function __construct()
    {
        $host = config()->database->host;
    }
}
