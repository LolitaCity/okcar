<?php

namespace App\Http\Middleware;

use App\Exceptions\AppException;
use App\Services\AdminService;
use Closure;

class AdminLoginAuth
{
    private $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $auth
     * @return mixed
     * @throws appException
     */
    public function handle($request, Closure $next, $auth = null)
    {
        $user = $this->service->currentUser();
        if (empty($user)) {
            throw new AppException('您尚未登录，请先登录', 1);
        }
        if (!empty($auth) && strpos($user->auth, $auth) === false) {
            throw new AppException('您没有权限', 1);
        }
        return $next($request);
    }
}
