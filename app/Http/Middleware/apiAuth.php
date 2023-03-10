<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class apiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $access_token = $request->header('access_token');
        if ($access_token != null) {
            $user = User::where("access_token", "=", $access_token)->first();
            if ($user != null) {

                return $next($request);
            } else {
                return response()->json([
                    "msg" => 'access token not valid'
                ],);
            }
        } else {
            return response()->json([
                "msg" => 'access token not found '
            ], );

        }








    }
}