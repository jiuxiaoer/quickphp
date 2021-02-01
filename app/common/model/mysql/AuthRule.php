<?php

namespace app\common\model\mysql;

use think\facade\Session;
use think\Model;

/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/1/16 12:26
 */
class AuthRule extends MysqlBase
{

    /**
     * 返回当前的验证规则json
     * @param string $field
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAuths($field = "*")
    {
        $where = [
            "status" => config("status.mysql.table_normal")
        ];
        $order = [
            "sort" => "asc",
            "id" => "asc"
        ];
        $res = $this->where($where)->field($field)->order($order)->select();
        return $res;
    }

    public function getAuthsByLoginUser($field = "*")
    {
        $gid = AuthGroupAccess::where('uid', Session::get(config("admin.admin_session"))["id"])->find()->group_id;
        $rules = AuthGroup::where('id', $gid)->find()->rules;

        $where = [
            "status" => config("status.mysql.table_normal")
        ];
        $order = [
            "sort" => "asc",
            "id" => "asc"
        ];
        $res = $this->where($where)->where("id", "in", $rules)
            ->field($field)->order($order)->select();
        return $res;
    }

    public function getAuthsAdmin($field = "*")
    {
        $data = [
            config("status.mysql.table_normal"),
            config("status.mysql.table_hide")
        ];

        $order = [
            "sort" => "asc",
            "id" => "asc"
        ];
        $res = $this->where("status", "in", $data)->field($field)->order($order)->select();
        return $res;
    }

    /**
     * 通过id获取权限数据
     * @param $id
     * @param string $field
     * @return array|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAuthRuleByID($id, $field = "*")
    {
        $where = [
            "id" => $id,
            "status" => config("status.mysql.table_normal")
        ];
        $res = $this->field($field)->where($where)->find();
        return $res;
    }

}