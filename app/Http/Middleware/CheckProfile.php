<?php

namespace App\Http\Middleware;

use Closure;

class CheckProfile
{

    public function handle($request, Closure $next)
    {
        if ($request->session()->get('userProfile') != 1) {

            // The profile is not full
            return redirect('home');
            
        }

        return $next($request);
    }

}