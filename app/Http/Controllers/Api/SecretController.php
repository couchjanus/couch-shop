<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Secret;

class SecretController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->user()) {
            return response()->json(['error' => 'User does not exist'], 500);
        }

        return $request->user()->secrets;
    }
}
