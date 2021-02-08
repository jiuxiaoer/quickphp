<?php
/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/2/8 12:42
 */

namespace app\admin\controller;

use app\admin\business\AdminLog;
use think\facade\View;

class  Log extends AdminBase
{
    public function index()
    {
        return View::fetch();
    }

    public function json()
    {
        $page = $this->request->param("page", 1, "intval");
        $limit = $this->request->param("limit", 10, "intval");
        try {
            $data = (new AdminLog())->getLogs("id,user_id,page,ip,data,agent,create_time", $limit);
        } catch (\Exception $e) {
            $data = [];
            echo $e->getMessage();
        }
        return json($data);
    }
}