<?php

namespace app\admin\validate;

use think\Validate;

class Group extends Validate
{
    protected $rule = [
        "id" => "require|integer|notIn:0",
        "status" => "in:-1,1",
        "rules" => "require",
        "title" => "require",
    ];
    protected $message = [
        "id" => "id异常",
        "status" => "状态异常",
        "title" => "名称不可为空",
        "rules" => "规则不可为空",
    ];
    protected $scene = [
        "save" => ["title", "rules", "status"],
        "delete" => ["id"],
        "update" => ["id", "title", "rules", "status"]
    ];

}