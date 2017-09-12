<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckAdmin
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
        if($request->session()->get('username')){
            return $next($request);
        }

        return redirect()->route('admin.getLogin', ['url' => $request->fullUrl()]);
    }
}
