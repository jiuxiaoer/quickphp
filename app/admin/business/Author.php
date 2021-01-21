<?php

namespace app\admin\business;

use app\common\model\mysql\AuthRule;

/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/1/17 19:48
 */
class Author
{
    /**
     * 权限数据模型
     * @var AuthRule|null
     */
    private $authRuleModel = null;

    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->authRuleModel = new AuthRule();
    }

    /**
     * 添加权限数据
     * @param $data
     * @throws \think\Exception
     */
    public function saveAuthor($data)
    {
        try {
            $this->authRuleModel->save($data);
        } catch (\Exception $E) {
            throw new \think\Exception("服务器内部异常");
        }
    }

    /**
     * 通过id获取一条权限数据
     * @param $id
     * @param $field
     * @return array
     * @throws \think\Exception
     */
    public function getAuthorRuleById($id, $field)
    {
        $res = $this->authRuleModel->getByID($id, $field);
        if (!$res) {
            throw new \think\Exception("id不存在");
        }
        return $res->toArray();
    }

    /**
     * 通过id更新数据
     * @param $id
     * @param $data
     * @return mixed
     * @throws \think\Exception
     */
    public function updateById($id, $data)
    {

        try {
            unset($data[0]);
            $res = $this->authRuleModel->updateById($id, $data);
        } catch (\Exception $e) {
            throw new \think\Exception("服务器内部异常");
        }
        return $res;
    }

    public function deleteById($id)
    {
        try {
            $res = $this->authRuleModel->deleteById($id);
        } catch (\Exception $e) {
            throw new \think\Exception("服务器内部异常");
        }
        return $res;
    }

    /**
     * 获取权限数据
     * @param $field
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getAuthJson($field)
    {
        $res = $this->authRuleModel->getAuthRuleJson($field);
        if (!$res) {
            $res = [];
        }
        return $res->toArray();
    }

    /**
     * 获取菜单栏数据
     * @param $field
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getMenuJson($field)
    {
        $res = $this->authRuleModel->getAuthRuleJson($field);
        if (!$res) {
            $res = [];
        }
        return $res = \app\common\lib\Arr::make_tree($res->toArray());
    }
}
