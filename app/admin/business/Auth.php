<?php

namespace app\admin\business;

/**
 * Class Auth
 * @package app\admin\business
 */
class Auth
{

    /**
     * 通过id获取用户的权限数据
     * @param $id
     * @return array|int
     */
    public function getAuthor($id)
    {
        $adminModel = new \app\common\model\mysql\AdminUser();
        $res = $adminModel->getAuthRules($id);
        if (!$res) {
            $res = [];
        }
        return $res;
    }
}