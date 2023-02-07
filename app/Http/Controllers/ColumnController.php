<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $column = Column::create([
            'title' => $request->title,
        ]);

        return back();
    }

    public function update(Request $request, Column $column)
    {
        //
    }

    public function destroy(Column $column)
    {
        //
    }
}
