<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymodeService;
use Illuminate\Http\Request;


class PayModeController extends Controller
{
    private $service;

    public function __construct(PaymodeService $service)
    {
        $this->service = $service;
    }

    // 列表
    public function getList(Request $request)
    {
        $input = $request->input();
        $ret = $this->service->getList($input);
        return $this->json($ret);
    }


    // 添加
    public function add()
    {
        return $this->json($this->service->create(request()->all()));
    }

    // 删除
    public function delete()
    {
        return $this->json([
            'success' => $this->service->remove(request()->input('id'))
        ]);
    }

    // 编辑
    public function edit()
    {
        return $this->json([
            'success' => $this->service->update(request()->input('id'), request()->all())
        ]);
    }
}
