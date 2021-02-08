<?php
/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/2/8 12:43
 */

namespace app\admin\business;

use app\common\model\mysql\AdminLog as adminLogModel;

class AdminLog
{
    private $adminLogModel = null;

    public function __construct()
    {
        $this->adminLogModel = new adminLogModel();
    }

    public function getLogs($field = "*", $limit)
    {
        $res = $this->adminLogModel->getLogByPage($field, $limit);
        if (!$res) {
            $res = [];
        }
        $total = $res->total();
        $items = $res->items();
        $res = [
            'code' => 0,
            'msg' => "",
            'count' => $total,
            'data' => $items
        ];
        return $res;
    }

    public function saveLog()
    {

    }
}