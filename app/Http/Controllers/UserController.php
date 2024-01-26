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

            
        }
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return Response('sucessful', $status=200);
        }
 
        return Response()->onlyInput('email');
    }

    public function show() {
        return User::all()->toJson();
    }
}
