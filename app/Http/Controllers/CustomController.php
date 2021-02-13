<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class CustomController
 * @package App\Http\Controllers
 */
class CustomController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}