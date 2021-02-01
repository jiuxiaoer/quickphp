<?php
/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/1/24 15:10
 */

namespace app\common\model\mysql;


class AuthGroupAccess extends MysqlBase
{

    public function updateByUid($id, $data)
    {
        $id = intval($id);
        if (empty($id) || empty($data) || !is_array($data)) {
            return false;
        }
        $where = [
            "uid" => $id
        ];
        return $this->where($where)->save($data);
    }
}