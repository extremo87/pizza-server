<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response(['message' => 'Invalid credentials'], 400);
            }
        } catch (JWTException $e) {
            return response(['message' => 'Could not create token'], 500);
        }

        return response(compact('token'));
    }

    public function register(Request $request)
    {
        $this->validate($request,  User::rules());

        $user = User::create([
            'name' => "$request->get('lastName') $request->get('firstName')",
            'firstname' => $request->get('firstName'),
            'lastname' => $request->get('lastName'),
            'phone' => preg_replace("/\D/", "", $request->get('phone')),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response(compact('user','token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response(['message' => 'User not found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response(['message' => 'Token expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response(['message' => 'Token invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response(['message' => 'Token is missing'], $e->getStatusCode());
        }

        return response(compact('user'));
    }
}

