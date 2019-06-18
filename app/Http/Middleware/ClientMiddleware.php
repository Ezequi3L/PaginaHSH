<?php

namespace App\Http\Middleware;

use Closure;

class ClientMiddleware
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

        if (($request->user()->tipo_de_usuario == 0)||($request->user()->tipo_de_usuario == 1)) {
           
            return redirect('home');

        }

        return $next($request);
    }
}
