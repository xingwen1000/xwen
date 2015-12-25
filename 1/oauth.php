<?php
$code = $_GET['code'];
$appKey = '3212333708';
$appSecret = '8e2d7c321b6787329893023c82b38877';
//判断code是否存在
if(!$code){
    header('location:https://api.weibo.com/oauth2/authorize?client_id='.$appKey.'&redirect_uri=http://xingwen1000.sinaapp.com/oauth.php&response_type=code');
    exit;
}
var_dump($code);exit;