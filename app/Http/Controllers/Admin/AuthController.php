<?php
/**
 * 企业用户管理
 * @author  nobody
 * @date    2019-01-17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Services\AuthenticationService;
use Request;


class AuthController extends Controller
{
    private $accountService;
    private $authService;

    public function __construct(AccountService $accountService, AuthenticationService $authService)
    {
        $this->accountService = $accountService;
        $this->authService = $authService;
    }

    // 登录
    public function getUserList()
    {
        return $this->json($this->accountService->getUserList(request()->input('keyword'), 20));
    }

    // 个人认证状态
    public function getPersonalAuthList()
    {
        return $this->json($this->authService->getPersonalAuthList(
            request()->input('keyword'),
            request()->input('status'),
            20));
    }

    // 通过/拒绝个人认证
    public function setPersonalPass()
    {
        $ret = $this->authService->setPersonalPass(
            request()->input('id'),
            !empty(request()->input('pass')),
            request()->input('reason')
        );
        return $this->json($ret);
    }

    // 企业认证状态
    public function getEnterpriseAuthList()
    {
        return $this->json($this->authService->getEnterpriseAuthList(
            request()->input('keyword'),
            request()->input('status'),
            20));
    }

    // 通过/拒绝企业认证
    public function setEnterprisePass()
    {
        $ret = $this->authService->setEnterprisePass(
            request()->input('id'),
            !empty(request()->input('pass')),
            request()->input('reason')
        );
        return $this->json($ret);
    }

}
