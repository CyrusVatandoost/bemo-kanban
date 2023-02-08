<?php

namespace App\Http\Controllers;

use App\Models\AccessToken;
use Illuminate\Http\Request;

class AccessTokenController extends Controller
{
    public function generate()
    {
        $token = new AccessToken();
        $token->token = bin2hex(random_bytes(8));
        $token->expires_at = now()->addDays(30);
        $token->save();

        return response()->json($token->token);
    }

    public static function checkToken($token)
    {
        $token = AccessToken::where('token', $token)->first();

        if (!$token) {
            return false;
        }

        if ($token->expires_at < now()) {
            return false;
        }
    }
}
