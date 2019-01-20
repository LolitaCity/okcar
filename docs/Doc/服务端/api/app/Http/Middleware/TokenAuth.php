<?php

namespace App\Http\Middleware;

use App\Exceptions\AppException;
use Closure;
use Illuminate\Support\Facades\Auth;

class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $checkLogin = 'true')
    {
        $token = $request->input("token");
        if (env("APP_ENV") == "local" && empty($token)) {
            // $token = "iqkceLWToRLORV7O3qmhk3DVdT80yMauGn83993G3YX6KTZLPp9R9R8z0aUs";
        }

        if ($checkLogin == 'true' && empty($token)) {
            throw new AppException('未登录', config('okcar.error.not_login'));
        }
        $ret = Auth::attempt(['password' => '', 'remember_token' => $token]);
        if ($checkLogin == 'true' && $ret == false) {
            throw new AppException('登录信息错误', config('okcar.error.expired'));
        }

        return $next($request);
    }
}
