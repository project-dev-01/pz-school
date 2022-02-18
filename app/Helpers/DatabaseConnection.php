<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseConnection
{
    public static function setConnection($params)
    {
        config(['database.connections.tenant' => [
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',
            'database'  => $params->db_name,
            'username'  => $params->db_username,
            'password'  => $params->db_password,
            'charset'   => 'utf8',
        ]]);
        return DB::connection('tenant');
    }
}
