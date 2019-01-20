<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/26
 * Time: 20:07
 */

namespace App\Http\Controllers;

use App\Models\Appearance;
use App\Models\Decoration;
use App\Models\EnterpriseAuthentication;
use App\Services\CarService;
use App\Services\PublishService;
use DB;
use App\Exceptions\AppException;

use App\Models\PublishInfo;
use App\Models\UserFavour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cache;

class CarController extends Controller
{
    public function modellist()
    {
        $result = Cache::get("model_list");
        if (!empty($result)) {
            $result  = json_decode($result, true);
        } else {
            $result = CarService::getModellist();
            Cache::put('model_list', json_encode($result));
        }
        return $this->json($result);
    }

    public function modelAppearanceInfo(Request $request)
    {
        $model = $request->input('model_id');
        $appears = Appearance::where('model_id', $model)->select('color')->get();
        $result = array_pluck($appears->toArray(), 'color');
        if (empty($result)) {
            $result = config('okcar')['color'];
        }
        return $this->json($result);

    }

    public function modelDecorationInfo(Request $request)
    {
        $model = $request->input('model_id');
        $decoration = Decoration::where('model_id', $model)->select('color')->get();
        $result = array_pluck($decoration->toArray(), 'color');
        if (empty($result)) {
            $result = config('okcar')['color'];
        }
        return $this->json($result);
    }

    public function publishDetail(Request $request, PublishService $service)
    {
        $publishId = $request->input('publish_id');
        $info = PublishInfo::with(['modelInfo', 'salerUser'])->where('id', $publishId)->get()->toArray();
        if (empty($info) || !isset($info[0])) {
            throw new AppException("无此车源", 1);
        }
        $carInfo = $info[0];

        // 抓取
        if ($carInfo['type'] == 1) {
            $carInfo['kefu_huanxin_id'] = config('okcar')['kefu_huanxin_id'];
            $carInfo['kefu_huanxin_agent'] = config('okcar')['kefu_huanxin_agent'];
        }

        $carInfo['kefu_tel'] = config('okcar')["kefu_tel"];
        $carInfo['link'] = sprintf(config('okcar')['share_url'], $carInfo['id']);

        $favour = 0;
        $user = Auth::user();
        if ($user) {
            $userId = $user->id;
            $favourInfo = UserFavour::where('user_id', $userId)->where('publish_id', $publishId)->get()->toArray();
            if (!empty($favourInfo)) {
                $favour = 1;
            }
        }
        $carInfo['is_favour'] = $favour;
        return $this->json($carInfo);
    }

    public function simPricePublish(Request $request, PublishService $service)
    {
        $price = $request->input('price');
        $pageNum = min($request->input('page_num'), PAGE_NUM);

        $list = $service->searchSimPricePublish($price, $pageNum);
        return $this->json($list);
    }

    public function publishUpdate(Request $request)
    {
        $publishId = $request->input('publish_id');
        if (empty($publishId)) {
            throw new AppException("参数错误", 1);
        }
        $updated = $request->only([
            'model_info_id',
            'appearance',
            'decoration',
            'custom_model' => '',
            'sale_price',
            'source',
            'formalities',
            'ticket_type',
            'comment',
            'pics' => '',
            'expire',
            'sale_area',
            'stock',
        ]);

        $this->validate($updated, [
            'model_info_id' => 'required|max:200|exists:model_info,id',
            'appearance' => 'required|max:200',
            'decoration' => 'required|max:200',
            'sale_price' => 'numeric',
            'source' => 'numeric',
            'formalities' => 'numeric',
            'ticket_type' => 'numeric',
            'comment' => 'max:500',
            'pics' => 'max:1000',
            'expire' => 'numeric',
            'custom_model' => 'max:200'
        ], [
            'model_info_id.*' => '车型必填',
            'appearance.*' => '外观必填',
            'decoration.*' => '内饰必填',
            'sale_price.*' => '销售价格必填',
            'source.*' => '车源所在地必填',
            'formalities.*' => '手续情况格式不正确',
            'ticket_type.*' => '票据类型格式不正确',
            'comment.*' => '评论不超过500字',
            'pics.*' => '图片url长度不超过1000',
            'expire.*' => '有效期格式不正确',
            'custom_model.*' => '自定义车型格式不正确'
        ]);

        if (isset($updated['expire'])) {
            $expire = $updated['expire'];
            $expireDate = date("Y-m-d", strtotime("$expire day"));
            $updated['expire'] = $expireDate;
        }

        $ret = PublishInfo::where('id', $publishId)->update($updated);
        if ($ret > 0) {
            return $this->json();
        }
        throw new AppException('修改失败', 1);
    }

    public function publishCreate(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $info = EnterpriseAuthentication::where('user_id', $userId)->get()->toArray();

        if (!isset($info[0]) || empty($info[0]) || $info[0]['status'] != AUTHENTICATION_SUC) {
            throw new AppException("请先进行企业认证后再提交车源信息", 1);
        }
        $modelInfo = $request->only([
            'model_info_id',
            'appearance',
            'decoration',
            'custom_model' => '',
            'sale_price',
            'source',
            'stock',
            'formalities',
            'ticket_type',
            'comment' => '',
            'pics' => '',
            'expire',
            'sale_area',s
        ]);

        $this->validate($modelInfo, [
            'model_info_id' => 'required|max:200|exists:model_info,id',
            'appearance' => 'required|max:200',
            'decoration' => 'required|max:200',
            'sale_price' => 'numeric',
            'source' => 'numeric',
            'formalities' => 'numeric',
            'ticket_type' => 'numeric',
            'comment' => 'max:500',
            'pics' => 'max:1000',
            'expire' => 'numeric',
            'custom_model' => 'max:200',
            'stock' => 'numeric',
        ], [
            'model_info_id.exists' => '车型不存在',
            'model_info_id.required' => '车型必填',
            'appearance.*' => '外观必填',
            'decoration.*' => '内饰必填',
            'sale_price.*' => '销售价格必填',
            'source.*' => '车源所在地必填',
            'formalities.*' => '手续情况格式不正确',
            'ticket_type.*' => '票据类型格式不正确',
            'comment.*' => '评论不超过500字',
            'pics.*' => '图片url长度不超过1000',
            'expire.*' => '有效期格式不正确',
            'custom_model.*' => '自定义车型格式不正确',
            'stock.*' => '期车格式不对',
        ]);
        $expire = $modelInfo['expire'];
        $expireDate = date("Y-m-d", strtotime("$expire day"));
        $modelInfo['expire'] = $expireDate;
        $modelInfo['user_id'] = $userId;

        $ret = PublishInfo::create($modelInfo);
        return $this->json($ret);
    }

    public function publishUp(Request $request)
    {
        $user = Auth::user();
        $publishId = $request->input('publish_id');
        $ret = PublishInfo::where('user_id', $user->id)->where('id', $publishId)->update(['status' => STATUS_UP]);
        if ($ret <= 0) {
            throw new AppException('上架失败', 1);
        }
        return $this->json();

    }

    public function publishDown(Request $request)
    {
        $user = Auth::user();
        $publishId = $request->input('publish_id');
        $ret = PublishInfo::where('user_id', $user->id)->where('id', $publishId)->update(['status' => STATUS_DOWN]);
        if ($ret <= 0) {
            throw new AppException('下架失败', 1);
        }
        return $this->json();
    }

    public function publishDelete(Request $request)
    {
        $user = Auth::user();
        $publishId = $request->input('publish_id');
        $ret = PublishInfo::where('user_id', $user->id)->where('id', $publishId)->delete();
        if ($ret <= 0) {
            throw new AppException('删除失败', 1);
        }
        return $this->json();
    }

    public function publishList(Request $request)
    {
        $user = Auth::user();
        $type = $request->input('type');
        if (!is_numeric($type)) {
            $type = STATUS_UP;
        }
        $pageNum = min($request->input('page_num'), PAGE_NUM);

        $info = PublishInfo::with(['modelInfo', 'salerUser'])->where('user_id', $user->id)->where('status', $type)->paginate($pageNum);
        $upCount = PublishInfo::where('user_id', $user->id)->where('status', STATUS_UP)->count();
        $downCount = PublishInfo::where('user_id', $user->id)->where('status', STATUS_DOWN)->count();

        $infoArr = $info->toArray();
        $infoArr['up_total'] = $upCount;
        $infoArr['down_total'] = $downCount;
        return $this->json($infoArr);
    }

    public function favour(Request $request)
    {
        $user = Auth::user();
        $publishId = $request->input('publish_id');
        $type = $request->input('type');
        if ($type == 0) {
            //收藏
            try {
                UserFavour::create(['user_id' => $user->id, 'publish_id' => $publishId]);
            } catch (\Exception $e) {
                throw new AppException('已收藏', 1);
            }
        } else if ($type == 1) {
            // 取消
            UserFavour::where('user_id', $user->id)->where('publish_id', $publishId)->delete();
        }
        return $this->json();
    }

    public function favourlist(Request $request)
    {
        $user = Auth::user();
        $pageNum = min($request->input('page_num'), PAGE_NUM);
        $list = $user->favourlist()->with(['modelInfo', 'salerUser'])->paginate($pageNum)->toArray();
        $data = $list['data'];
        $datalist = [];
        foreach ($data as $item) {

            $datalist[] = array_merge(array_get($item, 'pivot'), ['publish_info' => $item]);
        }
        $list['data'] = $datalist;
        return $this->json($list);
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $series = $request->input('series');
        $appearance = $request->input('appearance');
        $enterprise_type = $request->input('enterprise_type');
        $stock = $request->input('stock');
        $saleArea = $request->input('sale_area');
        $modelId = $request->input('model_id');
        $sortBy = $request->input('sort_by');
        $rule = $request->input('rule_id');
        $where = PublishInfo::with([
            'modelInfo.brandInfo',
            'salerUser.realnameAuth',
            'salerUser.enterpriseAuth'])
        ->join('model_info', function($query){
            $query->on('model_info.id', '=', 'model_info_id');
        })
        ->orderBy('model_info.produce_year', 'desc')
        ->select('public_info.*');

        $where = $where->where('status', STATUS_UP);

        $kw = '%' . $keyword . '%';

        if (!empty($rule)) {
            $where = $where->whereHas('modelInfo', function ($query) use ($rule) {
                $query->where('rule', $rule);
            });
        }
        if (!empty($keyword)) {
            $where = $where->where(function ($query) use ($kw, $rule) {
                $query->whereHas('modelInfo', function ($query) use ($kw) {
                    $query->where('series', 'like', $kw)->orWhere('model', 'like', $kw);
                })->orWhereHas('modelInfo.brandInfo', function ($query) use ($kw) {
                    $query->where('name', 'like', $kw);
                })->orWhereHas('salerUser.enterpriseAuth', function ($query) use ($kw) {
                    $query->where('enterprise_name', 'like', $kw);
                });
            });
        }
        if (is_numeric($stock)) {
            $where = $where->whereHas('modelInfo', function ($query) use ($stock) {
                $query->where('stock', $stock);
            });
        }

        if (is_numeric($saleArea)) {
            $where = $where->whereHas('modelInfo', function ($query) use ($saleArea) {
                $query->where('source', $saleArea);
            });
        }

        if (is_numeric($enterprise_type)) {
            $where = $where->whereHas('salerUser.enterpriseAuth', function ($query) use ($enterprise_type) {
                $query->where('enterprise_type', $enterprise_type);
            });
        }
        if (!empty($appearance)) {
            $where = $where->whereHas('modelInfo', function ($query) use ($appearance) {
                $query->where('appearance', $appearance);
            });
        }

        if (!empty($series)) {
            $where = $where->whereHas('modelInfo', function ($query) use ($series) {
                $query->where('series', $series);
            });
        }

        if (is_numeric($modelId)) {
            $where = $where->where('model_info_id', $modelId);
        }

        if (!empty($sortBy)) {
            if ($sortBy == 'publish_time') {
                $where->orderBy('updated_at', 'desc');
            }
            if ($sortBy == 'price_desc') {
                $where->orderBy('sale_price', 'desc');
            }
            if ($sortBy == 'price_asc') {
                $where->orderBy('sale_price', 'asc');
            }
        }
        $pageNum = min($request->input('page_num'), PAGE_NUM);
        $info = $where->paginate($pageNum);

        return $this->json($info);
    }

    public function searchCount(Request $request)
    {
        $keyword = $request->input('keyword');
        $rule = $request->input('rule_id');
        $where = PublishInfo::with(['modelInfo.brandInfo', 'salerUser.realnameAuth', 'salerUser.enterpriseAuth']);
        $where = $where->where('status', STATUS_UP);

        if (!empty($rule)) {
            $where = $where->whereHas('modelInfo', function ($query) use ($rule) {
                $query->where('rule', $rule);
            });
        }
        $kw = '%' . $keyword . '%';
        if (!empty($keyword)) {
            $where = $where->where(function ($query) use ($kw, $rule) {

                $query->whereHas('modelInfo', function ($query) use ($kw) {
                    $query->where('series', 'like', $kw)->orWhere('model', 'like', $kw);
                })->orWhereHas('modelInfo.brandInfo', function ($query) use ($kw) {
                    $query->where('name', 'like', $kw);
                })->orWhereHas('salerUser.enterpriseAuth', function ($query) use ($kw) {
                    $query->where('enterprise_name', 'like', $kw);
                });
            });
        }
        $modelCountWhere = clone($where);
        $appearanceCountWhere = clone($where);
        $saleAreaCountWhere = clone($where);
        $modelCount = $modelCountWhere->groupBy('model_info_id')->select(['model_info_id', DB::raw('count(*) as count')])->get();
        $appearanceCount = $appearanceCountWhere->groupBy('appearance')->select(['appearance', DB::raw('count(*) as count')])->get();
        $saleAreaCount = $saleAreaCountWhere->groupBy('source')->select(['source', DB::raw('count(*) as count')])->get();

        $yearList = array();
        $saleAreaList = array();

        foreach ($modelCount as $model) {
            $year = $model['modelInfo']['produce_year'];
            if (isset($yearList[$year])) {
                $yearInfo = $yearList[$year];
                $modelList = $yearInfo['model_list'];
            } else {
                $yearInfo['year'] = $year;
                $modelList = [];
            }
            $modelInfo = [
                'model_info_id' => $model['model_info_id'],
                'model' => $model['modelInfo']['model'],
                'count' => $model['count'],
            ];
            $modelList[] = $modelInfo;
            $yearInfo['model_list'] = $modelList;
            $yearList[$year] = $yearInfo;
        }
        $yearList = array_values($yearList);

        $appearanceList = [];
        foreach ($appearanceCount as $appearance) {
            $appearanceInfo['appearance'] = $appearance['appearance'];
            $appearanceInfo['count'] = $appearance['count'];
            $appearanceList[] = $appearanceInfo;
        }
        foreach ($saleAreaCount as $saleArea) {
            $saleAreaInfo['sale_area'] = $saleArea['source'];
            $saleAreaInfo['sale_area_desc'] = $saleArea['source_desc'];
            $saleAreaInfo['count'] = $saleArea['count'];
            $saleAreaList[] = $saleAreaInfo;
        }


        return $this->json([
            'model_count_list' => $yearList,
            'appearance_count_list' => $appearanceList,
            'sale_area_count_list' => $saleAreaList,
        ]);


    }
}
