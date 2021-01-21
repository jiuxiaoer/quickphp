<?php
// 应用公共文件
use app\common\lib\GeetestLib;
use think\facade\Session;
/**
 * @param int $status
 * @param string $message
 * @param array $data
 * @param int $httpStatus
 * @return \think\response\Json
 */
function show_json($status = 0, $message = "error", $data = [], $httpStatus = 200)
{
    $result = [
        "status" => $status,
        "message" => $message,
        "result" => $data
    ];
    return json($result, $httpStatus);

}
function getip()
{

    static $ip = '';

    $ip = $_SERVER['REMOTE_ADDR'];

    if (isset($_SERVER['HTTP_CDN_SRC_IP'])) {

        $ip = $_SERVER['HTTP_CDN_SRC_IP'];

    } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {

        foreach ($matches[0] AS $xip) {

            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {

                $ip = $xip;

                break;

            }

        }

    }

    return $ip;

}

function jy_validate($geetest_challenge, $geetest_validate, $geetest_seccode)
{
    $GtSdk = new GeetestLib(config("GtSdk.id"), config("GtSdk.key"));
    $code_flag = false;
    $data = array(
        "user_id" => Session::get("user_id"), # 网站用户id
        "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
        "ip_address" => getip() # 请在此处传输用户请求验证时所携带的IP
    );
    if (Session::get('gtserver') == 1) {
        $result = $GtSdk->success_validate($geetest_challenge, $geetest_validate, $geetest_seccode, $data);
        if ($result) {
            // 验证码验证成功
            $code_flag = true;
        } else {
            $code_flag = false;
        }
    } else {
        if ($GtSdk->fail_validate($geetest_challenge, $geetest_validate, $geetest_seccode)) {
            // 验证码验证成功
            $code_flag = true;
        } else {
            $code_flag = false;
        }
    }
    return $code_flag;
}

function layui_json($data, $code = 0, $msg = '')
{

    $res = [
        'code' => $code,
        'msg' => $msg,
        'count' => count($data),
        'data' => $data
    ];
    return json($res);
}

/**
 * 数组层级缩进转换
 * @param array $array 源数组
 * @param int $pid
 * @param int $level
 * @return array
 */
function array2level($array, $pid = 0, $level = 1)
{
    static $list = [];
    foreach ($array as $v) {
        if ($v['pid'] == $pid) {
            $v['level'] = $level;
            $list[] = $v;
            array2level($array, $v['id'], $level + 1);
        }
    }
    return $list;
}