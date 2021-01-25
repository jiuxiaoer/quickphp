<?php

namespace app\admin\validate;

use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
        "id" => "require|integer|notIn:0",
        "group_id" => "require|integer|notIn:0",
        "name" => "require|chsDash|length:4,25",
        "password" => "require|length:6,25",
        "phone" => "mobile",
        "geetest_challenge" => "require",
        "geetest_validate" => "require",
        "geetest_seccode" => "require",
    ];
    protected $message = [
        "id" => "id异常",
        "group_id" => "用户组id异常",
        "name" => "用户名只能是汉字、字母、数字和下划线_及破折号-,长度4-25之间",
        "password" => "密码不可为空,长度6-25之间",
        "phone" => "手机号错误",
        "geetest_challenge" => "验证失败！",
        "geetest_validate" => "验证失败！",
        "geetest_seccode" => "验证失败！",
    ];

    protected $scene = [
        "login" => ["name", "password", "geetest_challenge", "geetest_validate", "geetest_seccode"],
        "delete" => ["id"],
        "save" => ["group_id", "name", "password", "phone"],
        "update" => ["id", "group_id", "name", "password", "phone"],
        "update1" => ["id", "group_id", "name", "phone"]
    ];

}