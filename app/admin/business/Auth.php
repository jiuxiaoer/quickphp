<?php

namespace app\admin\business;

class Auth
{
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