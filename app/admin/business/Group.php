<?php

namespace app\admin\business;

use app\common\model\mysql\AuthGroup;

/**
 * Class Group
 * @package app\admin\business
 */
class Group
{
    /**
     * @var AuthGroup|null
     */
    private $authGroupModel = null;

    /**
     * Group constructor.
     */
    public function __construct()
    {
        $this->authGroupModel = new AuthGroup();
    }

    public function getGroups($field)
    {
        $res = $this->authGroupModel->getGroups($field);
        if (!$res) {
            $res = [];
        }
        return $res->toArray();
    }

    /**获取用户组数据分页
     * @param $field
     * @param $limit
     * @return array|\think\Paginator
     */
    public function getGruopsByPage($field, $limit)
    {
        $res = $this->authGroupModel->getGruopsByPage($field, $limit);
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

    /**
     * 添加用户组数据
     * @param $data
     * @throws \think\Exception
     */
    public function saveGroup($data)
    {
        try {
            $this->authGroupModel->save($data);
        } catch (\Exception $E) {
            throw new \think\Exception("服务器内部异常");
        }
    }

    /**
     * 通过id删除用户组
     * @param $id
     * @return array|\think\Model|null
     * @throws \think\Exception
     */
    public function deleteById($id)
    {
        try {
            $res = $this->authGroupModel->deleteById($id);
        } catch (\Exception $e) {
            throw new \think\Exception("服务器内部异常");
        }
        return $res;
    }

    /**
     * 通过id更新用户组
     * @param $data
     * @return bool
     * @throws \think\Exception
     */
    public function updateById($data)
    {
        try {
            $res = $this->authGroupModel->updateById($data["id"], $data);
        } catch (\Exception $e) {
            throw new \think\Exception("服务器内部异常");
        }
        return $res;
    }

    /**
     * 通过id获取用户组
     * @param $field
     * @param $id
     * @return array
     * @throws \think\Exception
     */
    public function getGroupById($field, $id)
    {
        $res = $this->authGroupModel->getByID($id, $field);
        if (!$res) {
            throw new \think\Exception("id不存在");
        }
        return $res->toArray();
    }
}