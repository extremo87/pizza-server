<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Events\UserRegistered;

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

        try {
            // We suppose that phone will be verified
            // in appropriate method after SMS code confirmation
            // but now just set verification time
            $phoneVerifiedAt = Carbon::now();

            $user = User::create([
                'name' => "$request->get('lastName') $request->get('firstName')",
                'firstname' => $request->get('firstName'),
                'lastname' => $request->get('lastName'),
                'phone' => preg_replace("/\D/", "", $request->get('phone')),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'phone_verified_at' => $phoneVerifiedAt
            ]);
        } catch (\Exception $exception) {
            return response(['message' => $exception->getMessage()], 500);
        }

        $token = JWTAuth::fromUser($user);

        // In real life this event would fire after phone verification
        event(new UserRegistered($user));

        return response(compact('user','token'), 201);
    }

    public function getAuthenticatedUser()
    {
        $user = auth()->user();

        return response(compact('user'));
    }
}

