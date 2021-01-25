<?php

namespace app\common\model\mysql;

class AuthGroup extends MysqlBase
{
    public function getGroups($field = "*")
    {
        $where = [
            "status" => config("status.mysql.table_normal")
        ];
        $order = [
            "id" => "asc"
        ];
        $res = $this->where($where)->field($field)->order($order)->select();
        return $res;
    }
    public function getGruopsByPage($field = "*", $limit)
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