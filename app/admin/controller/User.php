<?php
declare (strict_types=1);

namespace app\admin\controller;

use think\facade\View;

class User extends AdminBase
{
    public function index()
    {
        return View::fetch("");
    }

}
