<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Response;

use App\Models\User;


class AdminController extends Controller
{
    public function login(Request $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return Response([
                'message' => 'Invalid credentials!'
            ], response::HTTP_UNAUTHORIZED);
        }

        /** @var \App\Models\User $user **/

        $user = Auth::user();
        

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24);

        return response([
            'token' => $token
        ])->withCookie($cookie);
    }

    public function showUsersData() {
        return User::all()->toJson();
    }
}
