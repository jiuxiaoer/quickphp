<?php
declare (strict_types=1);

namespace app\admin\controller;

use think\facade\Session;
use think\facade\View;

class Index extends AdminBase
{
    public function index()
    {
        return View::fetch("", [
            "name" => Session::get(config("admin.admin_session"))["name"],
        ]);
    }

    public function console()
    {
        return View::fetch();
    }

    public function exit()
    {
        Session::clear();
        return View::fetch();
    }
}
