<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    private $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    // 列表
    public function getList(Request $request)
    {
        $input = $request->input();
        $ret = $this->service->getList($input);
        $emptyObj = (object)null;
        foreach($ret['data'] as $k => &$row) {
            $model_info = count($row['model_info']) > 0 ? $row['model_info'][0] : null;
            $row['model_info'] = !empty($model_info) ? $model_info : $emptyObj;

            $saler_info = count($row['saler_info']) > 0 ? $row['saler_info'][0] : null;
            $row['saler_info'] = !empty($saler_info) ? $saler_info : $emptyObj;

            $type = $row['public_info']['type'];
            $row['public_info']['type_desc'] = $type ? '是' : '否';
            $sale_price = isset($row['public_info']['sale_price']) ? $row['public_info']['sale_price'] : 0;
            $row['public_info']['sale_price_desc'] = $sale_price == 0 ? 0 : round($sale_price / 10000, 2); 
        }
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
