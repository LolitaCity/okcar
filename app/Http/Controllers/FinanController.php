<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/10/13
 * Time: 15:15
 */

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PayMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanController extends Controller
{
    public function payModelList() {
        $list  = PayMode::get()->toArray();
        return $this->json($list);
    }

    /**
     * 车源信息验证
     * 
     * @param Request $request
     * @return type
     */
    public function orderCreate(Request $request) {
        $user = Auth::user();
        $order = $request->only([
            'publish_id',
            'number',
            'address',
            'pay_mode_id',
            'comment' => '']);

        $this->validate($order, [
            'publish_id' => 'required|exists:public_info,id',
            'number' => 'required|numeric',
            'address' => 'required|numeric',
            'pay_mode_id' => 'required|exists:pay_mode,id',
            'comment' => 'max:200'
        ], [
            'publish_id.*' => '车源信息必填',
            'number.*' => '数量必填且为数字',
            'address.*' => '区域必填',
            'pay_mode_id.*' => '金融方案必填',
            'comment.*' => '备注不能超过200个字',
        ]);

        $order['buyer_id'] = $user->id;
        $ret = Order::create($order);
        return $this->json($ret);
    }
}
