<?php
/**
 * Created by IntelliJ IDEA.
 * User: lilina
 * Date: 2018/8/12
 * Time: 14:19
 */

namespace App\Library;

use App\Exceptions\AppException;
use Validator;

class Util
{
    public static function getAreaDesc($id)
    {
        foreach (config('arealist') as $value) {
            if ($id === $value['id']) {
                return $value['name'];
            }
            if (strpos(strval($id), strval($value['id'])) === 0) {
                foreach ($value['sub'] as $v) {
                    if ($v['id'] == $id) {
                        return $value['name'] . $v['name'];
                    }
                }
            }
        }
        return '';
    }

    public static function SHA256Hex($str)
    {
        $re = hash('sha256', $str, true);
        return bin2hex($re);
    }

    public static function validateCard($id)
    {

        $id = strtoupper($id);
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = array();
        if (!preg_match($regx, $id)) {
            return FALSE;
        }
        if (15 == strlen($id)) //检查15位
        {
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";
            @preg_match($regx, $id, $arr_split);
            //检查生日日期是否正确
            $dtm_birth = "19" . $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else      //检查18位
        {
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $id, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) //检查生日日期是否正确
            {
                return FALSE;
            } else {
                //检验18位身份证的校验码是否正确。
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ($i = 0; $i < 17; $i++) {
                    $b = (int)$id{$i};
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($id, 17, 1)) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }
    }

    public static function validate($data, $rule, $info)
    {
        $validator = Validator::make($data, $rule, $info);
        $messages = $validator->messages();
        foreach ($messages->toArray() as $key => $value) {
            throw new AppException(array_first($value), 1);
        }
        return array_only($data, array_keys($rule));
    }

    public static function getTime() {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
}

}
