<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class SetLanguage
 * @package App\Http\Middleware
 */
class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if exist Language in header apply this locale code to laravel request
        if($request->headers->get('Language')) {
            app()->setLocale($request->headers->get('Language'));
        }

        return $next($request);
    }
}
