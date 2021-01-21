<?php
/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/1/8 13:34
 */

namespace app\admin\controller;

use think\facade\Session;
use think\facade\View;

/**
 * Class Login
 * @package app\admin\controller
 */
class  Login extends AdminBase
{
    /**
     *
     */
    public function initialize()
    {
        if ($this->isLogin()) {
            return $this->redirect(url("index/index"));
        }
    }

    /**
     * @return string
     */
    public function index()
    {
        return View::fetch();
    }

    /**
     * 登陆验证接口
     * @return \think\response\Json
     */
    public function check()
    {
        if (!$this->request->isPost()) {
            return show_json(config("status.error"), "请求方式错误");
        }
        //参数校验
        $username = $this->request->param("username", "", "trim");
        $password = $this->request->param("password", "", "trim");
        $geetest_challenge = $this->request->param("geetest_challenge", "", "trim");
        $geetest_validate = $this->request->param("geetest_validate", "", "trim");
        $geetest_seccode = $this->request->param("geetest_seccode", "", "trim");
        $data = [
            "username" => $username,
            "password" => $password,
            "geetest_challenge" => $geetest_challenge,
            "geetest_validate" => $geetest_validate,
            "geetest_seccode" => $geetest_seccode,
        ];
        //校验层
        $validate = new \app\admin\validate\AdminUser();
        if (!$validate->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        $res = false;
        //验证登录逻辑
        try {
            $res = \app\admin\business\AdminUser::login($data);
        } catch (\Exception $e) {
            halt($e->getMessage());
            return show_json(config("status.error"), $e->getMessage());
        }
        if ($res) {
            return show_json(config("status.success"), "登录成功");
        } else {
            return show_json(config("status.error"), "登录失败");
        }

    }


}