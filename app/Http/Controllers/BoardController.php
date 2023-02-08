<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\DbDumper\Databases\MySql;

class BoardController extends Controller
{
    public function exportToSQL(Request $request)
    {
        $databaseName = config('settings.DB_DATABASE');
        $userName = config('settings.DB_USERNAME');
        $password = config('settings.DB_PASSWORD');

        MySql::create()
            ->setDbName($databaseName)
            ->setUserName($userName)
            ->setPassword($password)
            ->includeTables(['cards', 'columns'])
            ->dumpToFile('dump.sql');

        return response()->download(
            public_path('dump.sql')
        );
    }
}
