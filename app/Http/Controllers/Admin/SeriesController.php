<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SeriesService;
use Request;


class SeriesController extends Controller
{
    private $service;

    public function __construct(SeriesService $service)
    {
        $this->service = $service;
    }

    // 列表
    public function getList()
    {
        return $this->json($this->service->getList());
    }


    // 添加车系
    public function add()
    {
        return $this->json($this->service->create(request()->all()));
    }

    // 删除车系
    public function delete()
    {
        return $this->json([
            'success' => $this->service->remove(request()->input('id'))
        ]);
    }

    // 编辑车系
    public function edit()
    {
        return $this->json([
            'success' => $this->service->update(request()->input('id'), request()->all())
        ]);
    }
}
