<?php
/**
 * Created by PhpStorm.
 * User: ttt
 * Date: 2017/8/16
 * Time: 10:58
 */

require 'api_functions.php';

//假设使用方是 user_001 他拥有自己的appid和secret_key
$user = [
    'appid' => 'user_001',    //使用方对于提供方api的唯一id
    'secret_key' => '97bc847d4ea7dd9f035d41a657302f1c'    //密钥 也唯一

];

//生成token
$token = generate_token($user['appid'], $user['secret_key'], time());

//url换成你自己的接口url
$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);

$url .= '/api.php?api=user_info'; //调用user_info的接口
$url .= '&token=' . $token;

echo $url;
echo '<hr><pre>';

//请求接口
$res = sub_curl($url);

var_dump(json_decode($res, 1));