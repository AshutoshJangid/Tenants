<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($request->user()->type) {
                    case 'Sa':                
                        return redirect()->route('sa.dashboard');
                        break;
                        
                    case 'Ad':
                        return redirect()->route('ad.dashboard');
                        break;
                        
                    case 'Tn':
                        return redirect()->route('tn.dashboard');
                        break;

                    default:
                        return redirect(RouteServiceProvider::HOME);
                        break;
                    }
            }
        }

        return $next($request);
    }
}
