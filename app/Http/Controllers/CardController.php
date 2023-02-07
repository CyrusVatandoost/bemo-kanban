<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'column_id' => 'required|exists:columns,id',
        ]);

        $card = Card::create([
            'title' => $request->title,
            'column_id' => $request->column_id,
        ]);

        return back();
    }

    public function update(Request $request, Card $card)
    {
        //
    }

    public function destroy(Card $card)
    {
        //
    }
}
