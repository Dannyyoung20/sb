<?php

namespace App\Http\Controllers;

use App\Tutor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;
use Illuminate\Routing\Route;

class TutorAuthController extends Controller
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

        $tutor = Tutor::whereEmail(request('username'))->first();

        $data = request()->only('username', 'password');

        if (! $tutor || ! Hash::check($data['password'], $tutor->password)) {
            return response()->json([
                'error' => 'Incorrect email or password',
                'status' => 422
            ], 422);
        }
        return response()->json($tutor);

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

        $user = Tutor::create([
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
