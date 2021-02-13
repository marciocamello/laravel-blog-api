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
     * @OA\Post(
     *     path="/authenticate/login",
     *     tags={"Authenticate"},
     *     operationId="login",
     *     summary="Get token to authenticate",
     *     description="Create a new token to access",
     *     @OA\RequestBody(
     *         description="Login object that needs to be added to create a new token",
     *         required=true,
     *             @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\RequestBody(
     *         description="Login object that needs to be added to create a new token",
     *         required=true,
     *     ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input",
     *     )
     * )
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
