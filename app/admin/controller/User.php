<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\business\AdminUser as AdminUserBus;
use app\admin\business\Group as GroupBus;
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
     * 获取用户数据 分页json
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

    /**
     * 添加页面
     * @return string|\think\response\Json
     */
    public function add()
    {
        if ($this->request->isPost()) {
            return $this->save();
        }
        try {
            $group = (new GroupBus())->getGroups("id,title");
        } catch (\Exception $e) {
            $group = [];
            return show_json(config("status.error"), $e->getMessage());
        }
        return View::fetch("", [
            "group" => $group,
        ]);
    }

    /**
     * 添加方法
     * @return \think\response\Json
     */
    private function save()
    {
//        if (!$this->request->isPost()) {
//            return show_json(config("status.error"), "请求方式错误");
//        }
        $check = $this->request->checkToken("__token__");
        if (!$check) {
            return show_json(config("status.error"), "非法请求");
        }
        $group_id = $this->request->param("group_id", null, "intval");
        $name = $this->request->param("name", "", "trim");
        $password = $this->request->param("password", "", "trim");
        $phone = $this->request->param("phone", "", "trim");
        $data = [
            "group_id" => $group_id,
            "name" => $name,
            "password" => $password,
            "phone" => $phone
        ];
        //校验层
        $validate = new \app\admin\validate\AdminUser();
        if (!$validate->scene("save")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            (new AdminUserBus())->save($data);
        } catch (\Exception $e) {
            return show_json(config("status.error"), $e->getMessage());
        }
        return show_json(config("status.success"), "OK");
    }

    /**
     * 更新页面
     * @return string|\think\response\Json
     */
    public function edit()
    {
        if ($this->request->isPost()) {
            return $this->update();
        }
        $id = input("param.id", null, "intval");
        $data = [
            "id" => $id
        ];
        $validate = new \app\admin\validate\AdminUser();
        if (!$validate->scene("delete")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            $data = (new AdminUserBus())->getUserById($id, "id,name,phone");
            $group = (new GroupBus())->getGroups("id,title");
        } catch (\Exception $e) {
            $data = [];
            $group = [];
            return show_json(config("status.error"), $e->getMessage());
        }
        return View::fetch("", [
            "group" => $group,
            "data" => $data
        ]);
    }

    /**
     * 更新方法
     * @return \think\response\Json
     */
    private function update()
    {
//        if (!$this->request->isPost()) {
//            return show_json(config("status.error"), "请求方式错误");
//        }
        $check = $this->request->checkToken("__token__");
        if (!$check) {
            return show_json(config("status.error"), "非法请求");
        }
        $id = $this->request->param("id", null, "intval");
        $group_id = $this->request->param("group_id", null, "intval");
        $name = $this->request->param("name", "", "trim");
        $password = $this->request->param("password", "", "trim");
        $phone = $this->request->param("phone", "", "trim");
        $data = [
            "id" => $id,
            "group_id" => $group_id,
            "name" => $name,
            "password" => $password,
            "phone" => $phone
        ];
        //校验层
        $validate = new \app\admin\validate\AdminUser();
        if (empty($password)) {
            unset($data["password"]);
            if (!$validate->scene("update1")->check($data)) {
                return show_json(config("status.error"), $validate->getError());
            }
        } else {
            if (!$validate->scene("update")->check($data)) {
                return show_json(config("status.error"), $validate->getError());
            }
            $data["password"] = md5($data["password"] . "jiuxiao");
        }
        try {
            (new AdminUserBus())->updateById($data);
        } catch (\Exception $e) {
            return show_json(config("status.error"), $e->getMessage());
        }
        return show_json(config("status.success"), "OK");

    }

    /**
     * 删除api
     * @return \think\response\Json
     */
    public function delete()
    {
        $id = input("param.id", null, "intval");
        $data = [
            "id" => $id
        ];
        $validate = new \app\admin\validate\AdminUser();
        if (!$validate->scene("delete")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            (new AdminUserBus())->deleteById($id);
        } catch (\Exception $e) {
            return show_json(config("status.error"), $e->getMessage());
        }
        return show_json(config("status.success"), "OK");
    }


}
