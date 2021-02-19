<?php
/**
 * 后台模块控制器base文件
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/1/8 13:34
 */

namespace app\admin\controller;

use app\BaseController;
use think\exception\HttpResponseException;
use think\facade\Session;

class  AdminBase extends BaseController
{
    public function initialize()
    {
        parent::initialize(); // 继承父类
    }

    public function isLogin()
    {
        $this->adminUser = Session::get(config("admin.admin_session"));
        if (empty($this->adminUser)) {
            return false;
        }
        return true;
    }

    public function redirect(...$args)
    {
        throw new HttpResponseException(redirect(...$args));
    }

}