<?php
$code = $_GET['code'];//换取toke的码
$appKey = "3212333708";//申请应用成功后获取的
//判断code是否存在
if(!$code){
	//进入微博的登录授权页
	echo "<script>
location.href='https://api.weibo.com/oauth2/authorize?client_id=".$appKey."&response_type=code&redirect_uri=http://xingwen1000.sinaapp.com/oauth.php';
</script>";
}
//获取token
function getAccessToken($appKey,$appSecret,$code){
    $url = "https://api.weibo.com/oauth2/access_token?client_id=$appKey&client_secret=$appSecret&grant_type=authorization_code&redirect_uri=http://xingwen1000.sinaapp.com/oauth.php&code=$code";
	$res = httpsRequest($url,true);
    return $res->access_token;
    
}
//获取用户Id
function getuserid($token){
	$url = "https://api.weibo.com/2/account/get_uid.json?access_token=$token";
    $res = httpsRequest($url);
    return $res->uid;
}
//获取用户信息
function getusername($uid,$token){
	$url = "https://api.weibo.com/2/users/show.json?access_token=$token&uid=$uid";
     $res = httpsRequest($url);
    return $res;
}
function httpsRequest($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return json_decode($output);
}
$access_token = getAccessToken($appKey,$appSecret,$code);
$uid = getuserid($access_token);
$name = getusername($uid,$access_token);
print_r($name);