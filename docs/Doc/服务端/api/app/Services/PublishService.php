<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/9/3
 * Time: 21:57
 */

namespace App\Services;


use App\Models\PublishInfo;

class PublishService
{
    public function searchSimPricePublish($price, $pageNum)
    {
        $pageNum = min($pageNum, PAGE_NUM);
        $list = PublishInfo::with('modelInfo')->whereHas('modelInfo', function ($query) {
            $query->where('id', '>', 0);
        })->where('status', STATUS_UP)
            ->where('sale_price', '>', $price * 0.9)
            ->where('sale_price', '<', $price * 1.1)
            ->paginate($pageNum);
        return $list;
    }

    public function searchPublish($keyword, $series, $decoration, $source, $status, $enterprise_type)
    {

    }


}
