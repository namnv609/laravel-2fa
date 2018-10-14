<?php

namespace App\Http\Middleware;

use Closure;

class TwoFaceVerify
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
        $secretCode = auth()->user()->secret_code;

        if ($secretCode && !session("2fa_verified")) {
            return redirect()->route("two_face.index");
        }

        return $next($request);
    }
}
