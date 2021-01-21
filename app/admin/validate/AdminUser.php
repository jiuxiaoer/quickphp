<?php

namespace app\admin\validate;

use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
        "username" => "require",
        "password" => "require",
        "geetest_challenge" => "require",
        "geetest_validate" => "require",
        "geetest_seccode" => "require",
    ];
    protected $message = [
        "username" => "用户名不能为null",
        "password" => "密码不能为null",
        "geetest_challenge" => "验证失败！",
        "geetest_validate" => "验证失败！",
        "geetest_seccode" => "验证失败！",
    ];

}