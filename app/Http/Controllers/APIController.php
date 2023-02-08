<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getAllCards(Request $request)
    {
        $request->validate([
            'date' => ['nullable', 'date'],
            'status' => ['nullable', 'boolean'],
        ]);

        $date = $request->date;
        $status = $request->status;

        if ($status === '1') {
            $cards = Card::withoutTrashed()->get();
        } elseif ($status === '0') {
            $cards = Card::onlyTrashed()->get();
        } else {
            $cards = Card::withTrashed()->get();
        }

        if ($date) {
            $cards = $cards->filter(function ($card) use ($date) {
                return $card->created_at->format('Y-m-d') === $date;
            });
        }

        return response()->json($cards);
    }
}
