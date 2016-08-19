<?php

namespace App\Http\Middleware;

use Closure;


class Tamu
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
        if(session()->has('studentNim')){
            return redirect('student-dashboard');
        }else if(session()->has('lectureName')){
          return redirect('dashboard');
        }else if(session()->has('admin')){
          return redirect('admin-dashboard');
        }

        return $next($request);
    }
}
