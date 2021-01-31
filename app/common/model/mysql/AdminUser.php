<?php

namespace app\common\model\mysql;

use think\Model;


class AdminUser extends MysqlBase
{
    /**
     * 根据用户名获取数据
     * @param $username
     * @return array|bool|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAdminUser($name)
    {
        if (empty($name)) {
            return false;
        }
        $where = [
            "name" => trim($name)
        ];
        $res = $this->where($where)->find();
        return $res;
    }

    public function getUsers($field = "*")
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

    public function getUserByPage($field = "*", $limit)
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

    public function getRole($uid)
    {
        try {
            $gid = AuthGroupAccess::where('uid', $uid)->find()->group_id;
            $title = AuthGroup::where('id', $gid)->find()->title;
            return $title;
        } catch (\Exception $e) {
            return '此用户未授予角色';
        }

    }

    public function getRoleId($uid)
    {
        try {
            $gid = AuthGroupAccess::where('uid', $uid)->find()->group_id;
            $id = AuthGroup::where('id', $gid)->find()->id;
            return $id;
        } catch (\Exception $e) {
            return 0;
        }

    }

    public function getAuthRules($uid)
    {
        try {
            $gid = AuthGroupAccess::where('uid', $uid)->find()->group_id;
            $rules = AuthGroup::where('id', $gid)->find()->rules;
            $ruleList = AuthRule::where("id", "in", $rules)->where('href', '<>', "")->column('href');
            return $ruleList;
        } catch (\Exception $e) {
            return 0;
        }
    }
}