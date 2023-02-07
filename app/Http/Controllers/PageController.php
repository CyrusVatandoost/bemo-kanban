<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        $columns = Column::with('cards')->get();

        return Inertia::render('Home', [
            'columns' => $columns,
        ]);
    }
}
