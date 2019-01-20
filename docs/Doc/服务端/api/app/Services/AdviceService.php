<?php

namespace App\Services;

use App\Models\Advice;

class AdviceService
{

    public function getList($perPage = 20)
    {
        $data = Advice::with('user')->paginate($perPage);
        $list = [];
        foreach ($data->items() as $item) {
            $row = array_only($item->toArray(), ['content', 'created_at']);
            $row['phone'] = $item->user->phone;
            $row['name'] = $item->user->name;
            $list[] = $row;
        }
        return [
            'items' => $list,
            'page' => $data->currentPage(),
            'totalPage' => $data->lastPage(),
            'pageSize' => $data->perPage()
        ];
    }

}
