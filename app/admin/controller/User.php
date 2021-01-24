<?php
declare (strict_types=1);

namespace app\admin\controller;

use think\facade\View;
use app\admin\business\AdminUser;

/**
 * 用户
 * Class User
 * @package app\admin\controller
 */
class User extends AdminBase
{
    /**
     * @return string
     */
    public function index()
    {
        return View::fetch("");
    }

    /**
     * @return \think\response\Json
     */
    public function getUserJson()
    {
        $page = $this->request->param("page", 1, "intval");
        $limit = $this->request->param("limit", 10, "intval");
        try {
            $data = (new AdminUser())->getUsers("id,name,phone,create_time,update_time,login_ip", $limit);
        } catch (\Exception $e) {
            $data = [];
            echo $e->getMessage();
        }
        return json($data);
    }
}
