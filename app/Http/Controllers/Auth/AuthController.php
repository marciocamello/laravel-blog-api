<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Login route to return user logged with token
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function login(LoginRequest $request)
    {
        // validate user by password and email
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->remember)) {

            return response()->json([
                'errors' => __('authenticate.login_failed'),
            ], 400);
        }

        $user = User::find(auth()->id());
        //$user->tokens()->delete();
        $user->accessToken = $user->createToken('app-token')->plainTextToken;

        return response()->json([
            'message' => __('authenticate.login_success'),
            'response' => $user
        ], 200);
    }

    /**
     * Logout route to remove user from session
     */
    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => __('authenticate.logout_success'),
        ], 200);
    }
}
