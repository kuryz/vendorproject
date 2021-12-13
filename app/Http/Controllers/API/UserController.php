<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authenicate_login;
use App\Http\Requests\Authenicate_register;
use App\User;
use App\Events\UserEvent;
use App\Notifications\UserNotify;
use Auth;
use DB;
use JWTAuth;
use Validator;

class UserController extends Controller
{
	protected $user;
	/*
	AUTHENTICATE USER
	*/
	protected function authenticated($user = null) {

        if($user == null){
        	$user = JWTAuth::user();
        }

        event(new UserEvent($user));
    }

   /* function __construct($foo = null)
    {
    	if (!JWTAuth::user()) {
    		$this->user = JWTAuth::parseToken()->authenticate();
    	}
    	
    }*/

    public function login(Authenicate_login $request)
    {
        $credentials = $request->only('email', 'password');
        
        // $validator = Validator::make($credentials, $rules);
        // if($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error', 
        //         'message' => $validator->messages()
        //     ]);
        // }
        try {
            // Attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => 'error', 
                    'message' => 'We can`t find an account with this credentials.'
                ], 401);
            }
        } catch (JWTException $e) {
            // Something went wrong with JWT Auth.
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to login, please try again.'
            ], 500);
        }
        $this->authenticated();
        // All good so return the token
        return response()->json([
            'status' => 'success', 
            'data'=> [
                'token' => $token
                // You can add more details here as per you requirment. 
            ]
        ]);
    }

    public function register(Authenicate_register $request)
    {
    	$user = User::create([
    		'first_name' => $request->first_name,
    		'last_name' => $request->last_name,
    		'middle_name' => $request->middle_name,
    		'phone_number' => $request->phone_number,
    		'is_disabled' => $request->is_disabled,
    		'picture_url' => $request->picture_url,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    	]);

    	$user->notify(new UserNotify($user));
    	return response()->json([
    		'status' => 'success',
    		'message' => 'User created successfully',
    		'data' => $user
    	], 200);
    }

    public function show(Request $request)
    {
    	
    	return response()->json([
    		'status' => 'success',
    		'message' => 'user selected successfully',
    		'data' => JWTAuth::parseToken()->authenticate()
    	]);
    }

    public function update()
    {
    	
    }

    public function destroy()
    {
    	$user = User::find(JWTAuth::parseToken()->authenticate()->id);
    	if ($user->delete())
	    	return response()->json([
    		'status' => 'success',
    		'message' => 'user deleted successfully',
	    	]);
    }

    /**
     * Logout
     * Invalidate the token. User have to relogin to get a new token.
     * @param Request $request 'header'
     */
    public function logout(Request $request) 
    {
        // Get JWT Token from the request header key "Authorization"
        //$token = $request->('Authorization');
        $token = $request->token;
        // Invalidate the token
        try {
            JWTAuth::invalidate($token);
            return response()->json([
                'status' => 'success', 
                'message'=> "User successfully logged out."
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
              'status' => 'error', 
              'message' => 'Failed to logout, please try again.'
            ], 500);
        }
    }

    public function edit()
    {
    	# code...
    }
}
