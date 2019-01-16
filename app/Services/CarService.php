<?php

namespace App\Services;

use App\Library\Util;
use App\Models\ModelInfo;
use App\Models\Appearance;
use App\Models\Decoration;
use App\Models\BrandInfo;

class CarService
{

    private $validator = [
        'model' => 'required|min:1|max:50|unique:model_info,model',
        'brand_id' => 'required|min:1|max:200',
        'series' => 'required|min:1|max:200',
        'series_id' => 'required|min:1|max:200',
        'produce_year' => 'required|min:1|max:200',
        'guide_price' => 'required|min:1|max:200',
        'manufactures' => 'required|min:1|max:200',
        'rule' => 'required|min:1|max:2'
    ];

    private $errorMsg = [
        'model.unique' => '该车型已经存在',
        'model.*' => '名称必填且长度不能超过50',
    ];

    public function getList($input)
    {
        $brand_id = isset($input['brand_id']) ? $input['brand_id'] : '';
        $series_id = isset($input['series_id']) ? $input['series_id'] : '';
        return ModelInfo::with(['brandInfo', 'appearance', 'decoration'])
                ->where('brand_id', '=', $brand_id)
                ->where('series_id', '=', $series_id)->get()
                ->toArray();
    }

    public function create(array $item)
    {
        $data = Util::validate($item, $this->validator, $this->errorMsg);
        return ModelInfo::create($data);
    }

    public function remove($id)
    {
        return ModelInfo::where('id', $id)->delete();
    }
    /*
    * 拆分数组
    * @param array $input
    * @return array $ret
    */
    public function splitData(array $input) {
        if(!is_array($input)) {
            return false;
        }
        $arr_add = array();
        $arr_del = array();
        foreach($input as $k => $row) {
            if(isset($row['is_del'])) {
                $arr_del[] = $row['id'];
            } elseif(!isset($row['id'])) {
                $row['color'] = $row['color'];
                $arr_add[] = $row;
            }
        }
        return array(
                    'add' => $arr_add,
                    'del' => $arr_del
                );
    }

    public function update($id, array $item)
    {
        $appearance = json_decode($item['appearance'], true);
        $decoration = json_decode($item['decoration'], true);
        unset($item['appearance']);
        unset($item['decoration']);
        $res_app = $this->splitData($appearance);
        $res_dcr = $this->splitData($decoration);
        Appearance::insert($res_app['add']);
        Appearance::whereIn('id', $res_app['del'])->delete();
        Decoration::insert($res_dcr['add']);
        Decoration::whereIn('id', $res_dcr['del'])->delete();
        $validator = array_merge($this->validator, [
            'model' => 'required|min:1|max:50',
            'brand_id' => 'required|min:1|max:200',
            'series' => 'required|min:1|max:200',
            'series_id' => 'required|min:1|max:200',
            'produce_year' => 'required|min:1|max:200',
            'guide_price' => 'required|min:1|max:200',
            'manufactures' => 'required|min:1|max:200',
            'rule' => 'required|min:1|max:2'
        ]);
        $data = Util::validate($item, $validator, $this->errorMsg);
        return ModelInfo::where('id', $id)->update($data);
    }

    public static function getModellist() {
        $brandInfo = BrandInfo::with(['modelInfoList'])->where('flag', 0)->get();
        $brandList = [];
        foreach ($brandInfo as $item) {
            $brandId = $item->id;
            $brandInfo = ['logo' => $item->logo, 'name' => $item->name, 'pinyin' => $item->pinyin, 'rule_list' => []];
            $modelInfoList = $item->modelInfoList;

            $ruleList = [];
            $ruleInfo = [];
            foreach ($modelInfoList as $modelInfo) {
                $manufactureInfo = [];
                $manufactureList = [];
                $modelList = [];

                $ruleId = $modelInfo['rule'];
                $manufacture = $modelInfo['manufactures'];
                $modelId = $modelInfo['id'];
                $priority = $modelInfo['priority'];

                if (isset($brandInfo['rule_list'][$ruleId])) {
                    $ruleInfo = $brandInfo['rule_list'][$ruleId];
                    $manufactureList = $ruleInfo['manufacture_list'];
                    if (isset($manufactureList[$manufacture])) {
                        $manufactureInfo = $manufactureList[$manufacture];
                        $modelList = $manufactureInfo['model_list'];
                    }
                } else {
                    $ruleInfo['rule_id'] = $ruleId;
                }

                $modelList[$modelId] = $modelInfo->toArray();
                $manufactureInfo['manufacture'] = $manufacture;
                $manufactureInfo['priority'] = $priority;
                $manufactureInfo['model_list'] = $modelList;
                $manufactureList[$manufacture] = $manufactureInfo;
                $ruleInfo['manufacture_list'] = $manufactureList;
                $ruleList[$ruleId] = $ruleInfo;
                $brandInfo['rule_list'] = $ruleList;
                $brandList[$brandId] = $brandInfo;
            }
        }

        foreach ($brandList as &$brandInfo) {
            $brandInfo['rule_list'] = array_values($brandInfo['rule_list']);
            $ruleList = $brandInfo['rule_list'];
            foreach ($ruleList as &$ruleInfo) {
                $ruleInfo['manufacture_list'] = array_values($ruleInfo['manufacture_list']);
                $manufactureList = $ruleInfo['manufacture_list'];
                foreach ($manufactureList as &$manufactureInfo) {
                    $manufactureInfo['model_list'] = array_values($manufactureInfo['model_list']);
                }
                $ruleInfo['manufacture_list'] = $manufactureList;
            }
            $brandInfo['rule_list'] = $ruleList;
        }


        $list = config("okcar")['normal_brand_id'];
        $normalInfo = BrandInfo::whereIn('id', $list)->get();

        $result = [
            'brand_list' => array_values($brandList),
            'normal_brand' => $normalInfo,
        ];
        return $result;
    }
}
