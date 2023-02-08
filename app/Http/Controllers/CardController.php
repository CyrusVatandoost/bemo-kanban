<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Column;
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

        self::orderAllCards();

        return back();
    }

    public function add(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:cards,id',
            'column_id' => 'required|exists:columns,id',
            'order' => 'required|integer',
        ]);

        $card = Card::find($request->card_id);

        $card->update([
            'column_id' => $request->column_id,
            'order' => $request->order,
        ]);

        // Update the order of the cards in the column
        $cards = Card::where('column_id', $request->column_id)
            ->where('id', '!=', $card->id)
            ->where('order', '>=', $request->order)
            ->get();

        foreach ($cards as $card) {
            $card->update([
                'order' => $card->order + 1,
            ]);
        }

        self::orderAllCards();

        return back();
    }

    public static function orderAllCards()
    {
        foreach (Column::all() as $column) {
            $cards = Card::where('column_id', $column->id)->orderBy('order')->get();

            $order = 0;

            foreach ($cards as $card) {
                $card->update([
                    'order' => $order,
                ]);

                $order++;
            }
        }
    }
}
