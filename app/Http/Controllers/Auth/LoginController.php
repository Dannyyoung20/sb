<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/oauth/token';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Custom check Credential method
     * 
     * @return \App\User
     */
    public function checkCredentials() 
    {
        $user = User::whereEmail(request('username'))->first();
    
        if (! $user || ! Hash::check(request('password'), $user->password)) {
            return response()->json([
                'error' => 'Incorrect email or password',
                'status' => 422
            ], 422);
        } 
        // Add more checks in the future

        return $user;
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
        $user = $this->checkCredentials();

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
            'user' => $user,
            'status' => 200
        ]);
    }
}
