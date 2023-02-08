<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\DbDumper\Databases\MySql;

class BoardController extends Controller
{
    public function exportToSQL(Request $request)
    {
        // TODO: Test this in production

        $databaseName = env('DB_DATABASE');
        $userName = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        MySql::create()
            ->setDbName($databaseName)
            ->setUserName($userName)
            ->setPassword($password)
            ->includeTables(['cards', 'columns'])
            ->dumpToFile('dump.sql');
    }
}
