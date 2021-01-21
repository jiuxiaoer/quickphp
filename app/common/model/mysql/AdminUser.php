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
    public function getAdminUser($username)
    {
        if (empty($username)) {
            return false;
        }
        $where = [
            "name" => trim($username)
        ];
        $res = $this->where($where)->find();
        return $res;
    }


}