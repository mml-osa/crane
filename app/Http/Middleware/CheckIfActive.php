<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;

class CheckIfActive
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
        if($request->user()->active !== 1) { return redirect('logout')->withErrors(['active' => 'Your account is not active. Please contact your systems administrator!']); }
        return $next($request);
    }
}
