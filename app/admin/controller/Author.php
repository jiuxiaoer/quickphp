<?php
declare (strict_types=1);

namespace app\admin\controller;

use think\Exception;
use app\admin\business\Author as AuthorBus;
use think\facade\View;

/**
 * 权限路由
 * Class Author
 * @package app\admin\controller
 */
class Author extends AdminBase
{
    /**
     * @return string
     */
    public function index()
    {
        return View::fetch();
    }

    /**
     * 添加页面层
     * @return string
     */
    public function add()
    {
        $res = (new AuthorBus())->getAuths("id,title,pid");
        $data = array2Level($res);
        return View::fetch("", [
            "author" => $data
        ]);
    }

    /***
     * 删除api
     * @return \think\response\Json
     */
    public function delete()
    {
        $id = input("param.id", null, "intval");
        $data = [
            "id" => $id
        ];
        $validate = new \app\admin\validate\Author();
        if (!$validate->scene("delete")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            (new AuthorBus())->deleteById($id);
        } catch (Exception $e) {
            return show_json(config("status.error"), $e->getMessage());
        }
        return show_json(config("status.success"), "OK");
    }

    /**
     * 权限添加接口
     * @return \think\response\Json
     */
    public function save()
    {
        if (!$this->request->isPost()) {
            return show_json(config("status.error"), "请求方式错误");
        }
        $check = $this->request->checkToken("__token__");
        if (!$check) {
            return show_json(config("status.error"), "非法请求");
        }
        $pid = $this->request->param("pid", null, "intval");
        $sort = $this->request->param("sort", null, "intval");
        $status = $this->request->param("status", null, "intval");
        $type = $this->request->param("type", null, "intval");
        $title = $this->request->param("title", "", "trim");
        $href = $this->request->param("href", "", "trim");
        $icon = $this->request->param("icon", "", "trim");

        $data = [
            "pid" => $pid,
            "sort" => $sort,
            "status" => $status,
            "title" => $title,
            "href" => $href,
            "icon" => $icon,
            "type" => $type
        ];
        //校验层
        $validate = new \app\admin\validate\Author();
        if (!$validate->scene("save")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            (new AuthorBus())->saveAuthor($data);
        } catch (Exception $e) {
            return show_json(config("status.error"), $e->getMessage());
        }
        return show_json(config("status.success"), "OK");
    }

    /**
     * 修改页面视图
     * @return string|\think\response\Json
     */
    public function edit()
    {
        $id = input("param.id", null, "intval");
        $data = [
            "id" => $id
        ];
        $validate = new \app\admin\validate\Author();
        if (!$validate->scene("delete")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            $data = (new AuthorBus())->getAuthorRuleById($id, "id,title,href,icon,pid,sort,status,type");
            $res = (new AuthorBus())->getAuths("id,title,pid");
            $auth = array2Level($res);
        } catch (\Exception $e) {
            $data = [];
            $auth = [];
            return show_json(config("status.error"), $e->getMessage());
        }
        return View::fetch("", [
            "author" => $auth,
            "data" => $data
        ]);
    }

    /***
     * 更新api
     * @return \think\response\Json
     */
    public function update()
    {
        if (!$this->request->isPost()) {
            return show_json(config("status.error"), "请求方式错误");
        }
        $check = $this->request->checkToken("__token__");
        if (!$check) {
            return show_json(config("status.error"), "非法请求");
        }
        $id = $this->request->param("id", null, "intval");
        $pid = $this->request->param("pid", null, "intval");
        $type = $this->request->param("type", null, "intval");
        $sort = $this->request->param("sort", null, "intval");
        $status = $this->request->param("status", null, "intval");
        $title = $this->request->param("title", "", "trim");
        $href = $this->request->param("href", "", "trim");
        $icon = $this->request->param("icon", "", "trim");
        $data = [
            "id" => $id,
            "pid" => $pid,
            "sort" => $sort,
            "status" => $status,
            "title" => $title,
            "href" => $href,
            "icon" => $icon,
            "type" => $type
        ];
        //校验层
        $validate = new \app\admin\validate\Author();
        if (!$validate->scene("update")->check($data)) {
            return show_json(config("status.error"), $validate->getError());
        }
        try {
            (new AuthorBus())->updateById($data["id"], $data);
        } catch (\Exception $e) {
            return show_json(config("status.error"), $e->getMessage());
        }
        return show_json(config("status.success"), "OK");
    }

    /**
     * 权限数据api
     * @return \think\response\Json
     */
    public function authJson()
    {
        try {
            $data = (new AuthorBus())->getAuths("id,title,icon,type,pid,status,sort,create_time,update_time");
        } catch (\Exception $e) {
            $data = [];
        }
        return layui_json($data);
    }

    /**
     * 菜单栏数据
     * @return \think\response\Json
     */
    public function menu()
    {
        try {
            $data = (new AuthorBus())->getMenuJson("id,title,icon,href,type,pid");
        } catch (\Exception $e) {
            $data = [];
        }
        return json($data);
    }
}
