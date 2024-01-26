<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Response;


class AdminController extends Controller
{
    public function login(Request $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return Response([
                'message' => 'Invalid credentials!'
            ], response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        return $user;
    }
}
