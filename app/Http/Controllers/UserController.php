<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use LDAP\Result;

class UserController extends Controller
{
    public function store(Request $request) {
        if ($request->has('name') &&
            $request->has('lastname') &&
            $request->has('email')) {


            User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make('Pass!2345678'),
            ]);

            return Response('sucessful', $status=200);
            
        }
    }

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
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
