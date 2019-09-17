<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
// use App\Http\Resources\UserResource;
// use App\Http\Requests\UserRequest;
// use App\Http\Resources\UserCollection;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
	// 

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = DB::table('users')->get();
    	
        if (sizeof($users) < 1) {
            return response()->json([
                'errors' => 'No users found!'
            ], Response::HTTP_NOT_FOUND);
        }

        // return UserCollection::collection(User::paginate(10));
        return response()->json(compact('users'), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $error= "User not found!";
        
        // echo "It is working ...";

        if (!$user) {
            return response()->json(compact('error'), Response::HTTP_NOT_FOUND);
        }

        return response()->json(compact('user'), Response::HTTP_OK);
        // return new UserResource($user);
    }
}