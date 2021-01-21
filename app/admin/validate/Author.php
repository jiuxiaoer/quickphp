<?php

namespace app\admin\validate;

use think\Validate;

class Author extends Validate
{
    protected $rule = [
        "id" => "require|integer|notIn:0",
        "pid" => "require|integer",
        "sort" => "require|integer",
        "status" => "in:-1,1",
        "title" => "require",
//        "href" => "require",
        "icon" => "require",
        "type"=>"in:0,1"
    ];
    protected $message = [
        "id" => "id异常",
        "pid" => "上级权限异常",
        "sort" => "权重异常",
        "status" => "状态异常",
        "title" => "名称不可为空",
//        "href" => "url不可为空",
        "icon" => "icon不可为空",
        "type"=>"类型不存在"
    ];
    protected $scene = [
        "save" => ["pid", "sort", "status", "title", "icon","type"],
        "delete" => ["id"],
        "update" => ["id", "pid", "sort", "status", "title", "icon","type"]
    ];

}