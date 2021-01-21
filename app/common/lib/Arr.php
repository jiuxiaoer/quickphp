<?php
/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2020/8/24 20:19
 */

namespace app\common\lib;
/**
 * Class Arr
 * @package app\common\lib
 */
class Arr
{

    /**
     * 无限极分类
     * @param $arr
     * @return array
     */
    public static function make_tree($arr){
        $refer = array();
        $tree = array();
        foreach($arr as $k => $v){
            $refer[$v['id']] = & $arr[$k]; //创建主键的数组引用
        }
        foreach($arr as $k => $v){
            $pid = $v['pid'];  //获取当前分类的父级id
            if($pid == 0){
                $tree[] = & $arr[$k];  //顶级栏目
            }else{
                if(isset($refer[$pid])){
                    $refer[$pid]['children'][] = & $arr[$k]; //如果存在父级栏目，则添加进父级栏目的子栏目数组中
                }
            }
        }
        return $tree;
    }


}