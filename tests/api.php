<?php
/**
 * Created by PhpStorm.
 * User: ttt
 * Date: 2017/8/16
 * Time: 10:55
 */

require 'api_functions.php';

//授权的使用方名单 现为演示方便直接使用数组
$users = [
    'user_001'=>[
        'appid'=>'user_001',    //使用方对于提供方api的唯一id
        'secret_key'=>'97bc847d4ea7dd9f035d41a657302f1c'    //密钥 也唯一
    ],
    'user_002'=>[
        'appid'=>'user_002',
        'secret_key'=>'c763b64a62186ae6831edd22063539c4'
    ],
    'user_003'=>[
        'appid'=>'user_003',
        'secret_key'=>'51a683bea5e5c138fd0342fb70e03c65'
    ],
];

//检验签名
$token = isset($_GET['token']) ? trim($_GET['token']) : '';
if(empty($token)){
    echo_json(1000, 'token missed');
}

//解包token
$token_params = unpack_token($token);

if(empty($token_params['sign'])){
    echo_json(1001, 'sign error');  //签名为空或者错误
}

if(empty($token_params['appid'])){
    echo_json(1002, 'appid error');  //appid为空或者错误
}

if(empty($token_params['time'])){
    echo_json(1003, 'time error');  //time为空或者错误
}

if(abs($token_params['time'] - time()) > 10 * 60){    // api 调用时间限制左右浮动10分钟
    echo_json(1004, 'time expired');  // 10 minutes
}

//用appid取用户
$user = isset($users[$token_params['appid']]) ? $users[$token_params['appid']] : [];
if(empty($user)){
    echo_json(1005, 'appid not exists');  //调用方不存在
}

//使用调用方参数生成token
$create_token = generate_token($user['appid'], $user['secret_key'], $token_params['time']);

if($token !== $create_token){
    echo_json(1006, 'token error');  //token错误
}

//到此 调用权限的验证就ok了

$api = isset($_GET['api']) ? trim($_GET['api']) : '';

//接下来你可以有其他对具体接口的验证...


//返回结果
echo_json(200, 'your request api '.$api. ' success!');

