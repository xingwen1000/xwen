<?php
$url = 'https://api.weibo.com/oauth2/authorize?client_id=3212333708&redirect_uri=http://xingwen1000.sinaapp.com&response_type=code';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$output = curl_exec($ch);
var_dump(json_decode($output));exit;