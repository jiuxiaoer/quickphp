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
    /**
     * @param $request
     * @param \Closure $next
     * @return mixed
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
        return $res;

    }

    /**
     * 中间件结束调度
     * @param \think\Response $response
     */
    public function end(\think\Response $response)
    {

    }

}