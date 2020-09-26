<?php

namespace App\Http\Middleware;

use Closure;

class SanitizeMiddleware
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

        if ($request->has('phone')) {
            $request->request->add([
                'phone' => trim(preg_replace("/\D/", "", $request->phone))
            ]);
        }

        foreach ($request->input() as $key => $value) {
            if (!is_array($value)) {
                $request->request->set($key, trim(strip_tags($value)));
            }
        }

        return $next($request);
    }

}
