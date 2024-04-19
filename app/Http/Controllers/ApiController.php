<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts()
    {
        // get products
        $products = Product::paginate(10);
        return response()->json(['products' => $products]);
    }


    public function register(Request $request)
    {

        // validation
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        }

        // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // get token
        $token = $user->createToken('API Access');

        $accessToken = $token->accessToken;
        $expiresAt = $token->token->expires_at;

        return response()->json([
            'message' => 'User registered successfully',
            'accessToken' => $accessToken,
            'expiresAt' => $expiresAt,
            'tokenType' => 'Bearer',

        ], 201);
    }
    public function login(Request $request)
    {
        // validation
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        // compare password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // create token
        $token = $user->createToken('API Access');

        $accessToken = $token->accessToken;
        $expiresAt = $token->token->expires_at;

        return response()->json([
            'message' => 'User logged in successfully',
            'accessToken' => $accessToken,
            'expiresAt' => $expiresAt,
            'tokenType' => 'Bearer',

        ], 201);

    }

    public function publicEndpoint(Request $request)
    {
        // endpoint accessible without token
        return response()->json(['message' => 'This endpoint is accessible without a token']);
    }
    public function privateEndpoint(Request $request)
    {
        // endpoint accessible only with token
        return response()->json(['message' => 'Valid Token!']);
    }



}
