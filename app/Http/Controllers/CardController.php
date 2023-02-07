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

        $order = Card::where('column_id', $request->column_id)->count();

        $card = Card::create([
            'title' => $request->title,
            'column_id' => $request->column_id,
            'order' => $order,
        ]);

        return back();
    }

    public function update(Request $request, Card $card)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $card->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return back();
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
            Card::find($card['id'])->update([
                'column_id' => $card['column_id'],
                'order' => $card['order'],
            ]);
        }

        return back();
    }
}
