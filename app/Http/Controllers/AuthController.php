<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;
use Illuminate\Routing\Route;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validCred = validator($request->only('username', 'password'), [
            'username' => 'required|email|string',
            'password' => 'required|string'
        ]);

        if ($validCred->fails()) {
            $jsonErrorMsg = response()->json($validCred->errors()->all(), 400);
            return Response::json($jsonErrorMsg);
        }

        $data = request()->only('username', 'password');
        $hashPassword = Hash::make($data['password']);
        return response($hashPassword);
        $user = User::where('email', $data['username'])
                        ->where('password', $hashPassword)
                        ->get();

        if ($user) {
            return response()->json($user);
        }

        return response('Error');

    }

    public function register(Request $request)
    {
        $valid = validator($request->only('email', 'firstname', 'password','lastname'), [
            'firstname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'lastname' => 'required',
        ]);

        if ($valid->fails()) {
            $jsonError = response()->json($valid->errors()->all(), 400);
            return Response::json($jsonError);
        }

        $data = request()->only('email','firstname','password','lastname');

        $user = User::create([
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'lastname' => $data['lastname']
        ]);

        $client = Client::where('password_client', 1)->first();

        $request->request->add([
            'grant_type'    => 'password',
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'username'      => $data['email'],
            'password'      => $data['password'],
            'scope'         => null,
        ]);

        $token = Request::create(
            'oauth/token',
            'POST'
        );
        return \Route::dispatch($token);
    }
}
