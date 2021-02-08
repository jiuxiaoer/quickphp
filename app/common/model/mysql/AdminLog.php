<?php
namespace app\common\model\mysql;
use app\common\model\mysql\MysqlBase;
use think\facade\Session;

/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/2/8 12:43
 */
class AdminLog extends MysqlBase
{
    public function getLogByPage($field = "*", $limit){
        $where = [
            "user_id"=>Session::get(config("admin.admin_session"))["id"],
            "status" => config("status.mysql.table_normal")
        ];
        $order = [
            "id" => "desc"
        ];
        $res = $this->where($where)->field($field)->order($order)->paginate($limit);
        return $res;
    }
}