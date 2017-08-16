<?php
/**
 * Created by PhpStorm.
 * User: ttt
 * Date: 2017/8/16
 * Time: 11:02
 */

/**
 * 生成token
 * @param string $appid
 * @param string $secret_key
 * @param int $time
 * @return string
 */
function generate_token($appid, $secret_key, $time)
{
    $sign = sha1($appid . $secret_key . $time);
    return base64_encode($appid . ',' . $time . ',' . $sign);
}

/**
 * 解包token
 * @param string $token
 * @return array
 */
function unpack_token($token){
    $params = base64_decode($token);
    $params = explode(',', $params);

    return [
        'appid'=> isset($params[0]) ? $params[0] : '',
        'time'=> isset($params[1]) ? $params[1] : '',
        'sign'=> isset($params[2]) ? $params[2] : '',
    ];
}

/**
 * @param $url
 * @param array $data
 * @param bool $is_post
 * @param array $header
 * @return mixed
 */
function sub_curl($url, $data = array(), $is_post = false, $header = array())
{
    $ch = curl_init();
    if (!$is_post && !empty($data)) {
        $url = $url . '?' . http_build_query($data);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, $is_post);
    if ($is_post) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    if (!empty($header)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    $info = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($code != 200){

        echo_json($code, 'api调用出错'.$code);
    }
    curl_close($ch);
    return $info;
}

/**
 * @param int $code
 * @param string $msg
 * @param array $data
 */
function echo_json($code, $msg = '', $data = array()){
    header('Content-type:application/json');
    echo json_encode(array('ret' => $code, 'msg' => $msg, 'data' => $data));
    exit;
}