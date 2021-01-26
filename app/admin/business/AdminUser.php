<?php
/**
 * 后台用户操作逻辑
 * Class User
 * @package app\admin\business
 */

namespace app\admin\business;

use think\Exception;
use think\facade\Log;
use think\facade\Session;
use app\common\model\mysql\AdminUser as adminUserModel;

class AdminUser
{
    private $adminUserModel = null;

    public function __construct()
    {
        $this->adminUserModel = new adminUserModel();
    }

    /**
     * 后台登录逻辑校验
     * @param $data
     * @return bool
     * @throws Exception
     */
    public static function login($data)
    {
        try {
            $code_flag = jy_validate($data["geetest_challenge"], $data["geetest_validate"], $data["geetest_seccode"]);
            // 如果验证码验证成功，再进行其他校验
            if ($code_flag) {
                //验证成功
                $adminUserObj = new \app\common\model\mysql\AdminUser();
                //判断用户是否存在
                $adminUser = self::getAdminUserByName($data["name"]);
                if (empty($adminUser)) {
                    throw new Exception("不存在该用户");
                }
                //判断用户密码是否一致
                if ($adminUser["password"] != md5($data["password"] . "jiuxiao")) {
                    throw new Exception("密码错误");
                }
                //更新用户数据
                $login_ip = getip();
                $update_time = date("Y-m-d h:i:s");
                $updateDate = [
                    "update_time" => $update_time,
                    "login_ip" => $login_ip
                ];
                $res = $adminUserObj->updateByID($adminUser["id"], $updateDate);
                if (empty($res)) {
                    throw new Exception("登录失败");
                }
                Session::set(config("admin.admin_session"), $adminUser);
                Log::write("账号id-" . $adminUser["id"] . "-登陆时间-" . $update_time . "-登陆ip-" . $login_ip,
                    'info');
                Log::close();
                return true;
            } else {
                throw new Exception("验证码验证失败,请重新验证");
            }
        } catch (\Exception $e) {
            //抛出错误
            throw new Exception($e->getMessage());
            // return show_Json(config("status.error"), $e->getMessage());
        }

    }

    /**
     * 通过用户名判断用户是否存在
     * @param $username
     * @return array|bool|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getAdminUserByName($name)
    {
        $adminUserObj = new \app\common\model\mysql\AdminUser();
        //判断用户是否存在
        $adminUser = $adminUserObj->getAdminUser($name);
        if (empty($adminUser) || $adminUser->status != config("status.mysql.table_normal")) {
            return false;
        }
        $adminUser = $adminUser->toArray();
        return $adminUser;
    }

    public function getUserById($id, $field)
    {
        $res = $this->adminUserModel->getByID($id, $field);
        if (!$res) {
            throw new \think\Exception("id不存在");
        }
        $res->group_id = $this->adminUserModel->getRoleId($res->id);
        return $res->toArray();
    }

    /***
     * 获取用户json数据
     * @param $field
     * @param $limit
     * @return array|\think\Paginator
     */
    public function getUsers($field, $limit)
    {
        $res = $this->adminUserModel->getUserByPage($field, $limit);
        foreach ($res as &$v) {
            $v->role = $this->adminUserModel->getRole($v->id);
        }
        if (!$res) {
            $res = [];
        }
        $total = $res->total();
        $items = $res->items();
        $res = [
            'code' => 0,
            'msg' => "",
            'count' => $total,
            'data' => $items
        ];
        return $res;
    }

    public function updateById($data)
    {
        try {
            $res = (new \app\common\model\mysql\AuthGroupAccess())->updateByUiD($data["id"], ["group_id" => $data["group_id"]]);
            unset($data["group_id"]);
            $res = $this->adminUserModel->updateById($data["id"], $data);
        } catch (\Exception $e) {
            throw new \think\Exception("服务器内部异常");
        }
        return $res;
    }

    public function save($data)
    {
        try {
            $model = new adminUserModel();
            $group_id = $data["group_id"];
            unset($data["group_id"]);
            $data["password"] = md5($data["password"] . "jiuxiao");
            $model->save($data);
            $res = (new \app\common\model\mysql\AuthGroupAccess())->save(["uid" => $model->id, "group_id" => $group_id]);
        } catch (\Exception $e) {
            throw new \think\Exception("服务器内部异常");
        }
        return $res;
    }

    public function deleteById($id)
    {
        try {
            $res = $this->adminUserModel->deleteById($id);
        } catch (\Exception $e) {
            throw new \think\Exception("服务器内部异常");
        }
        return $res;
    }
}