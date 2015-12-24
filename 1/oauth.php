<?php
$url = 'https://api.weibo.com/oauth2/authorize?client_id=3212333708&redirect_uri=xingwen1000.sinaapp.com/oauth.php&response_type=code';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$output = curl_exec($ch);
curl_close($ch);
var_dump(json_decode($output));exit;