<?php

namespace app\common\model\mysql;

class AuthGroup extends MysqlBase
{

    public function getAuthGroup($field = "*", $limit)
    {
        $where = [
            "status" => config("status.mysql.table_normal")
        ];
        $order = [
            "id" => "asc"
        ];
        $res = $this->where($where)->field($field)->order($order)->paginate($limit);
        return $res;
    }
}