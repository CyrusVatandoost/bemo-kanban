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

    public function updateOrder(Request $request)
    {
        $request->validate([
            'cards' => 'required|array',
            'cards.*.id' => 'required|exists:cards,id',
            'cards.*.column_id' => 'required|exists:columns,id',
            'cards.*.order' => 'required|integer',
        ]);

        foreach ($request->cards as $card) {
            $card = Card::find($card['id']);
            $card->column_id = $card['column_id'];
            $card->order = $card['order'];
            $card->save();
        }

        return back();
    }
}
