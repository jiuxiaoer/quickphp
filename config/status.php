<?php
/**
 * 业务状态码配置
 */
return [
    //成功
    "success" => 1,
    //错误
    "error" => -1,
    "mysql"=>[
        "table_normal"=>1,//正常
        "table_pedding"=>0,//待审核
        "table_delete"=>-1//删除
    ]

];