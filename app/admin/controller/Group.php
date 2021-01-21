<?php

namespace app\admin\controller;


use app\admin\business\Group as GroupBus;
use think\facade\View;

/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/1/19 19:22
 */
class Group extends AdminBase
{
    public function index()
    {
        return View::fetch();
    }

    public function edit()
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
            $data = (new GroupBus())->getGroupById("id,title,status,rules", $id);
        } catch (\Exception $e) {
            $data = [];
            return show_json(config("status.error"), $e->getMessage());
        }

        return View::fetch("", [
            'data' => $data
        ]);
    }

    public function update()
    {

    }

    public function groupJson()
    {
        $page = $this->request->param("page", 1, "intval");
        $limit = $this->request->param("limit", 10, "intval");
        try {
            $data = (new GroupBus())->getGruopJson("id,title,status", $limit);
        } catch (\Exception $e) {
            $data = [];
            echo $e->getMessage();
        }
        return json($data);
    }
}