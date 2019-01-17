<?php
/**
 * 车型管理
 * 
 * @author  nobody
 * @date    2019-01-17
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CarService;
use Illuminate\Http\Request;


class CarController extends Controller
{
    private $service;

    public function __construct(CarService $service)
    {
        $this->service = $service;
    }

    // 列表
    public function getList(Request $request)
    {
        $input = $request->input();
        $res = $this->service->getList($input);
        $arr_produce_year = array();
        $arr_manufactures = array();
        $arr_rule_desc = array();
        foreach($res as $k => &$row) {
            $produce_year = $row['produce_year'];
            if(!isset($arr_produce_year[$produce_year])) {
                $arr_produce_year[$produce_year] = array('text' => $produce_year, 'value' => $produce_year);
            }

            $manufactures = $row['manufactures'];
            if(!isset($arr_manufactures[$manufactures])) {
                $arr_manufactures[$manufactures] = array('text' => $manufactures, 'value' => $manufactures);
            }

            $rule_desc = $row['rule_desc'];
            if(!isset($arr_rule_desc[$rule_desc])) {
                $arr_rule_desc[$rule_desc] = array('text' => $rule_desc, 'value' => $rule_desc);
            }
        } 
        $ret = array();
        $ret['list'] = $res;
        $ret['dstc_data'] = array(
                                'produce_year' => array_values($arr_produce_year),
                                'manufactures' => array_values($arr_manufactures),
                                'rule_desc' => array_values($arr_rule_desc)
                            );
        return $this->json($ret);
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
