<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\User;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * method for logging in a user
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {

            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token'), Response::HTTP_ACCEPTED);
        // return json_encode([
        //     compact('token')
        // ], Response::HTTP_OK);
    }

    /**
     * method for logging in a user
     */
    public function postRegister(Request $request)
    {
        $this->validate($request, [
        	'name'		=> 'required',
            'email'    	=> 'required|email|max:255|unique:users',
            'password' 	=> 'required',
        ]);

        DB::table('users')->insert(
        	[
        		'name'	=> $request->name,
        		'email'	=> $request->email,
        		'password'	=> app('hash')->make($request->password),
        		'telephone' => $request->telephone ? $request->telephone : null,
        		'occupation'=> $request->occupation ? $request->occupation : null,
        		'role'	=> $request->role ? $request->role : null,
        		'status'=> $request->status ? $request->status : 'user'
        	]
        );

        return response()->json([
            'data'  => 'User saved successfully! '
        ], Response::HTTP_CREATED);

    }
}