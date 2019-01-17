<?php
/**
 * 品牌管理
 * 
 * @author  nobody
 * @date    2019-01-17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BrandService;
use Request;


class BrandController extends Controller
{
    private $service;

    public function __construct(BrandService $service)
    {
        $this->service = $service;
    }

    // 列表
    public function getList()
    {
        return $this->json($this->service->getList());
    }


    // 添加品牌
    public function add()
    {
        return $this->json($this->service->create(request()->all()));
    }

    // 删除品牌
    public function delete()
    {
        return $this->json([
            'success' => $this->service->remove(request()->input('id'))
        ]);
    }

    // 编辑品牌
    public function edit()
    {
        return $this->json([
            'success' => $this->service->update(request()->input('id'), request()->all())
        ]);
    }
}
