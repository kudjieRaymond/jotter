<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{

	/**
	 * @param Illuminate\Http\Request $request
	 * 
	 * @return \Illuminate\Http\JsonResponse
	 * 
	 */
	
	public function login(Request $request)
	{
		$data = $request->validate([
			'email' => 'required',
			'password' => 'required',
		]);

		if(!$token = auth()->attempt($request->only("email", "password"))){
			return response()->json(["error"=>"Unauthorized "], 401);
		}
		return $this->respondWithToken($token);

	}

	/**
	 * @param Illuminate\Http\Request $request
	 * 
	 * @return \Illuminate\Http\JsonResponse
	 * 
	 */

	public function register(Request $request)
	{
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
		]);

		$token = auth()->login($user);

		return $this->respondWithToken($token);

	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth()->logout();

		return response()->json(["message" =>'User logged out Successfully']);
	}


	

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh()
	{
		//Catch error on wrong token
			return $this->respondWithToken(auth()->refresh());
	}

	/**
	 * Get the token array structure
	 * 
	 * @param string $token
	 * 
	 * @return \Illuminate\Http\JsonResponse
	 *
	 */
	protected function respondWithToken($token)
	{
		return response()->json([
			'access_token' => $token,
			'token_type'   => 'bearer',
			'expires_in' =>  auth()->factory()->getTTL() * 60
		]);
	}
}
