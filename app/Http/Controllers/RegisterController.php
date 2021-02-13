<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        try{
            $request->validate([
                'name' => ['required'],
                'email' => ['required','email', 'unique:users'],
                'password' => ['required','min:8', 'confirmed'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json($user);
        }catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
