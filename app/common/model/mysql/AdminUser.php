<?php

namespace app\common\model\mysql;

use think\Model;


/**
 * Class AdminUser
 * @package app\common\model\mysql
 */
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

    /**
     * 获取所有用户的数据
     * @param string $field
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
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

    /**
     * 获取用户数据 分页
     * @param string $field
     * @param $limit
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
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

    /**
     * 获取用户的 用户组 和 id
     * @param $uid
     * @param string $field
     * @return mixed|string
     */
    public function getRole($uid, $field = "*")
    {
        try {
            $gid = AuthGroupAccess::where('uid', $uid)->find()->group_id;
            $data = AuthGroup::where('id', $gid)->field($field)->find();
            return $data;
        } catch (\Exception $e) {
            return 'error';
        }

    }

    /**
     * 获取用户 用户组的 id
     * @param $uid
     * @return int|mixed
     */
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

    /**
     * @param $uid
     * @return array|int
     */
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