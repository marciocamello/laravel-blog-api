<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;

/**
 * Class BroadcastingController
 * @package App\Http\Controllers
 */
class BroadcastingController extends CustomController
{
    /*
    |--------------------------------------------------------------------------
    | API UserResource Route
    |--------------------------------------------------------------------------
    |
    */
    /**
     * Authenticate broadcasting
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        if ($token = $request->bearerToken()) {
            $model = Sanctum::$personalAccessTokenModel;
            $accessToken = $model::findToken($token);

            if($accessToken && $accessToken->tokenable){

                return response()->json(['auth' => $accessToken->tokenable]);
            }else{
                return response(['message' => 'Unauthorized'], 401);
            }
        }else{
            return response(['message' => 'Unauthorized'], 401);
        }

    }
}
