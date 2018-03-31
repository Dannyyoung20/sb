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
    /**
     * Custom check Credential method
     * 
     * @return \App\User
     */
    public function checkCredentials() 
    {
        // $tutor = Tutor::whereEmail(request('username'))->first();
        $tutor = Tutor::where('email', request('username'))->first();
        dd($tutor);
        if (! $tutor || ! Hash::check(request('password'), $tutor->password)) {
            return response()->json([
                'error' => 'Incorrect email or password',
                'status' => 422
            ], 422);
        } 
        // Add more checks in the future

        return $tutor;
    }

    /**
     * Custom generate oauth Token method
     * 
     * @return Illuminate\Http\Request
     */
    public function generateToken() 
    {
        $data = [
            'client_id' => env('CLIENT_ID', true),
            'client_secret' => env('CLIENT_SECRET', true),
            'grant_type' => env('GRANT_TYPE', 'password'),
            'username' => request('username'),
            'password' => request('password')
        ];
    
        $request = Request::create('oauth/token', 'POST', $data);
        return $request;
    }

    /*
    * Custom Login method
    */
    public function login() 
    {
        $tutor = $this->checkCredentials();

        $request = $this->generateToken();
        
        $response = app()->handle($request);

        // Check if the request was successful
        if ($response->getStatusCode() != 200) {
            return response()->json([
                'error' => 'Incorrect email or password',
                'status' => 422
            ], 422);
        }

        // Get the data from the response
        $data = json_decode($response->getContent());

        // Format the final response in a desirable format
        return response()->json([
            'access_token' => $data->access_token,
            'expires_in' => $data->expires_in,
            'user' => $tutor,
            'status' => 200
        ]);
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
