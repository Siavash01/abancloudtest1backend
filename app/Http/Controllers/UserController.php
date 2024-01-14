<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request) {
        if ($request->has('name') &&
            $request->has('lastname') &&
            $request->has('email')) {

            $user = new User;
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;

            $user->save();
        }
    }
}
