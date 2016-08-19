<?php

namespace App\Http\Middleware;

use Closure;

class Lecture
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
      if (!session()->has('lectureName')) {
        return redirect('/');
      }
        return $next($request);
    }
}
