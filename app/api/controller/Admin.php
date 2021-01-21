<?php
declare (strict_types=1);

namespace app\api\controller;

use app\common\lib\GeetestLib;
use think\facade\Session;

class Admin extends ApiBase
{
    public function verify()
    {
        $GtSdk = new GeetestLib(config("GtSdk.id"), config("GtSdk.key"));
        if (!isset($_SESSION['user_id'])) {
            Session::set('user_id', uniqid());
        }
        $data = array(
            "user_id" => Session::get("user_id"), # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => getip() # 请在此处传输用户请求验证时所携带的IP
        );
        $status = $GtSdk->pre_process($data, 1);
        Session::set('gtserver', $status);
        echo $GtSdk->get_response_str();
    }
}
