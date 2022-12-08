<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    // name, email and password should be passed in as part of the request
    public function register(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|min:3',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                ]
            );

            if ($validator->fails()) {
                // JSON that will be returned in the response
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'validation error',
                        $validator->errors()
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            // validation passed
            $user = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]
            );
            $token = $user->createToken('music-store-token')->plainTextToken;

            // create the successful response including the token
            return response()->json(
                [
                    'status' => true,
                    'message' => 'User Created Successfully',
                    'token' => $token
                    // HTTP_OK has the value 200 - success
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("music-store-token")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // This function returns the user profile, but only if they are logged in.
    public function user()
    {
        return response()->json(['user' => auth()->user()], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], Response::HTTP_OK);
    }
}
