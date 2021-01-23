<?php

namespace app\admin\business;

use app\common\model\mysql\AuthGroup;

class Group
{
    private $authGroupModel = null;

    public function __construct()
    {
        $this->authGroupModel = new AuthGroup();
    }

    public function getGruopJson($field, $limit)
    {
        $res = $this->authGroupModel->getAuthGroup($field, $limit);
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

    public function saveGroup($data)
    {
        try {
            $this->authGroupModel->save($data);
        } catch (\Exception $E) {
            throw new \think\Exception("服务器内部异常");
        }
    }

    public function deleteById($id)
    {
        try {
            $res = $this->authGroupModel->deleteById($id);
        } catch (\Exception $e) {
            throw new \think\Exception("服务器内部异常");
        }
        return $res;
    }

    public function updateById($data)
    {
        try {
            $res = $this->authGroupModel->updateById($data["id"], $data);
        } catch (\Exception $e) {
            throw new \think\Exception("服务器内部异常");
        }
        return $res;
    }

    public function getGroupById($field, $id)
    {
        $res = $this->authGroupModel->getByID($id, $field);
        if (!$res) {
            throw new \think\Exception("id不存在");
        }
        return $res->toArray();
    }
}