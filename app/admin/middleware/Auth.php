<?php
declare(strict_types=1);

namespace app\admin\middleware;

use think\facade\Session;

/**
 * Auther: yinshen
 * url:https://www.79xj.cn
 * 创建时间：2021/1/8 14:02
 */
class Auth
{
//不加入权限控制的路由,适合一些公共信息
    protected $notCheck = [
        '/admin/index/index',
        "/admin/author/menu",
        "/admin/login/index",
        "/admin/login/check",
        "/admin/Group/groupJson",
        "/admin/index/console",
        "/admin/author/authjson",
        "/admin/group/groupjson",
        "/admin/user/getuserjson",
        "/admin/author/add"
    ];

    /***
     * @param $request
     * @param \Closure $next
     * @return mixed|\think\response\Json|\think\response\Redirect
     */
    public function handle($request, \Closure $next)
    {
        //前置中间件
        //如果没登录并且访问非登录页面
        if (empty(Session::get(config("admin.admin_session"))) && preg_match("/login/", $request->pathinfo()) != 1) {
            dump(empty(Session::get(config("admin.admin_session"))));
            return redirect((string)url("login/index"));
        }
        $res = $next($request);
        //后置中间件
        $url = "/" . app('http')->getName() . '/' . $request->controller() . '/' . $request->action();
        $bool = self::isAuth(strtolower($url));
        if (!$bool) {
            return json("权限不足", 404);
        }
        return $res;

    }

    /**
     * 中间件结束调度
     * @param \think\Response $response
     */
    public function end(\think\Response $response)
    {

    }

    public function isAuth($url)
    {
        $res = (new \app\admin\business\Auth())->
        getAuthor(Session::get(config("admin.admin_session"))["id"]);
        // 排除权限
        $not_check = [];
        foreach ($this->notCheck as $value) {
            array_push($not_check,strtolower($value));
        }
        $res = array_merge($res, $not_check);

        $bool = in_array($url, $res);
        return $bool;
    }

}