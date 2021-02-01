<?php
/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/1/19 14:43
 */

namespace app\common\model\mysql;

use think\Model;

/**
 * Class MysqlBase
 * @package app\common\model\mysql
 */
class MysqlBase extends Model
{
    /**
     * 通过id修改数据
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateByID($id, $data)
    {
        $id = intval($id);
        if (empty($id) || empty($data) || !is_array($data)) {
            return false;
        }
        $where = [
            "id" => $id
        ];
        return $this->where($where)->save($data);
    }

    /**
     * 通过id删除数据
     * @param $id
     * @return array|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function deleteById($id)
    {
        $res = $this->find($id);
        $res->status = config("status.mysql.table_delete");
        $res->save();
        return $res;
    }

    /**
     * 根据id获取数据
     * @param $id
     * @param string $field
     * @return array|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getByID($id, $field = "*")
    {
        $where = [
            "id" => $id
        ];
        $res = $this->field($field)->where($where)->find();
        return $res;
    }
}