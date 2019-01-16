<?php

namespace App\Services;

use App\Models\EnterpriseAuthentication;
use Cache;
use App\Models\RealnameAuthentication;

class AuthenticationService
{

    public function getPersonalAuthList($keyword, $status, $perPage = 20)
    {
        $where = RealnameAuthentication::with('user');

        if (is_numeric($status)) {
            $where = $where->where('status', $status);
        }

        $kw = '%' . $keyword . '%';
        $where = $where->where(function ($query) use ($kw) {
            $query->whereHas('user', function ($query) use ($kw) {
                $query->where('phone', 'like', $kw)->orWhere('name', 'like', $kw);
            });
        });

        $data = $where->orderBy('id', 'desc')->paginate($perPage);
        $list = [];
        forEach ($data->items() as $item) {
            $item = $item->makeVisible('updated_at')->toArray();
            $item = array_merge($item['user'], $item);
            $item = array_only($item, ['id', 'phone', 'name', 'idcard_front_pic', 'idcard_back_pic', 'card_pic',
                'idcard_num', 'realname', 'status', 'updated_at', 'reason', 'status_desc']);
            $list[] = $item;
        }
        return [
            'items' => $list,
            'page' => $data->currentPage(),
            'totalPage' => $data->lastPage(),
            'pageSize' => $data->perPage()
        ];
    }

    public function setPersonalPass($id, $pass, $reason)
    {
        return RealnameAuthentication::where('id', $id)->where('status', AUTHENTICATION_ING)->update([
            'status' => ($pass ? AUTHENTICATION_SUC : AUTHENTICATION_FAIL),
            'reason' => ($reason ? $reason : '')
        ]);
    }

    public function getEnterpriseAuthList($keyword, $status, $perPage = 20)
    {
        $where = EnterpriseAuthentication::with('user');

        if (is_numeric($status)) {
            $where = $where->where('status', $status);
        }

        $kw = '%' . $keyword . '%';
        $where = $where->where(function ($query) use ($kw) {
            $query->whereHas('user', function ($query) use ($kw) {
                $query->where('phone', 'like', $kw)->orWhere('name', 'like', $kw);
            });
        });

        $data = $where->orderBy('id', 'desc')->paginate($perPage);
        $list = [];
        forEach ($data->items() as $item) {
            $item = $item->makeVisible('updated_at')->toArray();
            $item = array_merge($item['user'], $item);
            $item = array_only($item, [
                'id',
                'phone',
                'name',
                'enterprise_name',
                'enterprise_type',
                'enterprise_type_desc',
                'legal_person_name',
                'area',
                'area_desc',
                'status',
                'updated_at',
                'reason',
                'status_desc',
                'pics',
            ]);
            $list[] = $item;
        }
        return [
            'items' => $list,
            'page' => $data->currentPage(),
            'totalPage' => $data->lastPage(),
            'pageSize' => $data->perPage()
        ];
    }

    public function setEnterprisePass($id, $pass, $reason)
    {
        return EnterpriseAuthentication::where('id', $id)->where('status', AUTHENTICATION_ING)->update([
            'status' => ($pass ? AUTHENTICATION_SUC : AUTHENTICATION_FAIL),
            'reason' => ($reason ? $reason : '')
        ]);
    }

}
