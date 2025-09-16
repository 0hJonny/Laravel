<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();


        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message'=>'Invalid credentials'], 401);
        }
        
        $device = $request->input('device', 'unknown');

        return response()->json([
            'token' => $user->createToken($device)->plainTextToken,
            'user'  => [
                'user_name'  => $user->user_name,
                'email' => $user->email,
        ],
        ]);
    }

    public function getUser(Request $request)
    {
        $u = $request->user();

        return response()->json([
            'user_name' => $u->user_name,
            'email'     => $u->email,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'Logged out']);
    }
}
