<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Class LoginController
 * @package App\Http\Controllers
 */
class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($request->only('email', 'password'))) {

                return response()->json(Auth::user(), 200);
            }

            throw ValidationException::withMessages([
                'email' => ['Credentials are incorrect']
            ]);

        } catch (ValidationException $e) {

            return response()->json([
                'errors' => $e->validator->errors()
            ]);
        }
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {
        Auth::logout();
    }
}
