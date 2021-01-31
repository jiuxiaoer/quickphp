<?php

namespace app\admin\controller;


use app\admin\business\Group as GroupBus;
use think\facade\View;

/**
 * 用户组
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/1/19 19:22
 */
class Group extends AdminBase
{
    /**
     * @return string
     */
    public function index()
    {
        return View::fetch();
    }

    /**
     * 用户添加视图
     * @return string
     */
    public function add()
    {
        if ($this->request->isPost()) {
            return $this->save();
        }
            return View::fetch();

    }

    /**
     * 用户添加api
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
        $title = $this->request->param("title", "", "trim");
        $status = $this->request->param("status", null, "intval");
        $rules = $this->request->param("layuiTreeCheck_", null, "intval");
        if ($rules != null) {
            $rules = implode(",", $rules);
        }

        $data = [
            "title" => $title,
            "status" => $status,
            "rules" => $rules
        ];
        //校验层
        $validate = new \app\admin\validate\Group();
        if (!$validate->scene("save")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            (new GroupBus())->saveGroup($data);
        } catch (\Exception $e) {
            return show_json(config("status.error"), $e->getMessage());
        }
        return show_json(config("status.success"), "OK");
    }

    /**
     * 用户删除api
     * @return \think\response\Json
     */
    public function delete()
    {
        $id = input("param.id", null, "intval");
        $data = [
            "id" => $id
        ];
        $validate = new \app\admin\validate\Group();
        if (!$validate->scene("delete")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            (new GroupBus())->deleteById($id);
        } catch (\Exception $e) {
            return show_json(config("status.error"), $e->getMessage());
        }
        return show_json(config("status.success"), "OK");
    }

    /**
     * 用户编辑视图
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
            $validate = new \app\admin\validate\Group();
            if (!$validate->scene("delete")->check($data)) {
                return show_json(config("status.error"), $validate->getError());
            }
            try {
                $data = (new GroupBus())->getGroupById("id,title,status,rules", $id);
            } catch (\Exception $e) {
                $data = [];
                return show_json(config("status.error"), $e->getMessage());
            }
            return View::fetch("", [
                'data' => $data
            ]);

    }

    /***
     * 用户更新api
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
        $title = $this->request->param("title", "", "trim");
        $status = $this->request->param("status", null, "intval");
        $rules = $this->request->param("layuiTreeCheck_", null, "intval");
        $rules = implode(",", $rules);
        $data = [
            "id" => $id,
            "title" => $title,
            "status" => $status,
            "rules" => $rules
        ];
        //校验层
        $validate = new \app\admin\validate\Group();
        if (!$validate->scene("update")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            (new GroupBus())->updateById($data);
        } catch (\Exception $e) {
            return show_json(config("status.error"), $e->getMessage());
        }
        return show_json(config("status.success"), "OK");
    }

    /**
     * 用户组api
     * @return \think\response\Json
     */
    public function groupJson()
    {
        $page = $this->request->param("page", 1, "intval");
        $limit = $this->request->param("limit", 10, "intval");
        try {
            $data = (new GroupBus())->getGruopsByPage("id,title,status", $limit);
        } catch (\Exception $e) {
            $data = [];
        }
        return json($data);
    }
}