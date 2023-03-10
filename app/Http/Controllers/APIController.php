<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function getAllCards(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'access_token' => 'required',
            'date' => 'nullable|date',
            'status' => 'nullable|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $access_token = $request->access_token;

        if (AccessTokenController::checkToken($access_token) === false) {
            return response()->json(['error' => 'Invalid access token.'], 401);
        }

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
