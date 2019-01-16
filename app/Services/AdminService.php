<?php

namespace App\Services;

use App\Models\AdminUser;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\AppException;
use App\Library\Util;

class AdminService
{
    public function login($name, $password, $remember = false)
    {
        $ret = Auth::guard('admin_api')->attempt(['name' => $name, 'password' => $password], $remember);
        return $ret;
    }

    public function logout()
    {
        return Auth::guard('admin_api')->logout();
    }

    public function changePassword($oldPassword, $newPassword)
    {
        $user = $this->currentUser();
        if (empty($user)) {
            return false;
        }
        if (!Hash::check($oldPassword, $user->password)) {
            throw new AppException('原始密码不正确，请重新输入', 1);
        }
        $user->password = Hash::make($newPassword);
        return $user->save();
    }

    public function currentUser()
    {
        return Auth::guard('admin_api')->user();
    }

    public function reg($username, $password, $auth)
    {
        return AdminUser::create([
            'name' => $username,
            'password' => Hash::make($password),
            'auth' => $auth,
        ]);
    }

    public function getBaseInfo()
    {
        $auth = Auth::guard('admin_api');
        return [
            'login' => $auth->check(),
            'user' => $auth->user(),
        ];
    }

    public function getUserList($keyword, $perPage = 20)
    {
        $data = AdminUser::where('name', 'like', "%${keyword}%")->paginate($perPage);
        return [
            'items' => $data->items(),
            'page' => $data->currentPage(),
            'totalPage' => $data->lastPage(),
            'pageSize' => $data->perPage()
        ];
    }

    public function create(array $item)
    {
        $validator = [
            'name' => 'required|min:2|max:50||unique:admin_user,name',
            'password' => 'required|min:6|max:50',
            'auth' => 'regex:/^[\d]*$/',
        ];
        $errorMsg = [
            'name.unique' => '该用户名已存在',
            'name.*' => '名称只能是字母、数字、下划线，长度2-50位',
            'password.*' => '密码长度至少6位',
            'auth.*' => '权限格式不正确',
        ];
        $data = Util::validate($item, $validator, $errorMsg);
        $data['password'] = Hash::make($data['password']);
        return AdminUser::create($data);
    }

    public function delete($id)
    {
        return AdminUser::where('id', $id)->delete();
    }

    public function edit($id, array $row)
    {
        $updated = [];
        if (!empty($row['auth'])) {
            $updated['auth'] = $row['auth'];
        }
        if (!empty($row['password'])) {
            $validator = [
                'password' => 'required|min:6|max:50',
            ];
            $errorMsg = [
                'password.*' => '密码长度至少6位',
            ];
            Util::validate($row, $validator, $errorMsg);
            $updated['password'] = Hash::make($row['password']);
        }
        return AdminUser::where('id', $id)->update($updated);
    }

}
