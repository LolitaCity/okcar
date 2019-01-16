<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Request;

class AccountController extends Controller
{
    private $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    // 登录
    public function login()
    {
        $req = request();
        //var_dump($req);exit;
        return $this->json([
            'success' => $this->service->login(
                $req->input('username'),
                $req->input('password'),
                !empty($req->input('remember'))
            )
        ]);
    }

    // 退出登录
    public function logout()
    {
        $this->service->logout();
        return redirect('/admin');
    }

    // 获取基础信息
    public function getBaseInfo()
    {
        return $this->json($this->service->getBaseInfo());
    }

    // 修改密码
    public function changePassword()
    {
        $req = request();
        return $this->json([
            'success' => $this->service->changePassword($req->input('old'), $req->input('password'))
        ]);
    }

    // 管理员列表
    public function getList()
    {
        return $this->json($this->service->getUserList(request()->input('keyword'), 20));
    }

    // 创建账户
    public function create()
    {
        return $this->json($this->service->create(request()->all()));
    }

    // 删除账户
    public function delete()
    {
        return $this->json([
            'success' => $this->service->delete(request()->input('id'))
        ]);
    }

    // 编辑
    public function edit()
    {
        return $this->json([
            'success' => $this->service->edit(request()->input('id'), request()->all())
        ]);
    }

}
