<?php
header('content-type:text/html;charset=utf-8');
$code = $_GET['code'];
$appKey = '3212333708';
$appSecret = '8e2d7c321b6787329893023c82b38877';
$uri = 'http://xingwen1000.sinaapp.com/oauth.php';
if(!$code){
    header('location:https://api.weibo.com/oauth2/authorize?client_id='.$appKey.'&redirect_uri='.$uri.'&response_type=code');
    exit;
}
$url = 'https://api.weibo.com/oauth2/access_token?client_id=' . $appKey . '&client_secret=' . $appSecret . '&grant_type=authorization_code&code=' . $code . '&redirect_uri=' . $uri;
$result = httpRequest($url,'');
$result = json_decode($result,true);
$access_token = $result['access_token'];
//返回最新的公共微博
if($access_token){
    $url = 'https://api.weibo.com/2/statuses/public_timeline.json?access_token='.$access_token;
    $result = httpRequest($url);
    var_dump($result);
    exit;
}else{
    echo '获取access_token失败';exit;
}
function httpRequest($url,$data = null){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    if($data !== null){
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    }
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

