<?php

namespace App\Http\Controllers;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends CustomController
{

    /*
    |--------------------------------------------------------------------------
    | WEB Dashboard Route
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Home page to dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => 'Dashboard'
        ]);
    }

    /**
     * Login page to dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return response()->json([
            'message' => 'Please you need authenticate'
        ]);
    }

    /**
     * Remember password page to dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function rememberPassword()
    {
        echo "rememberPassword";
    }

    /**
     * Register page to dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        echo "register";
    }
}
