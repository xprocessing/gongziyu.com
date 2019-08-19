<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>关于我们-杭州公子鱼科技</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/default.css">

</head>

<body>

	<?php include '../share/header.php';?>
	<div class="main">
	

			<?php
$code = $_GET['code'];
$state = $_GET['state'];
//换成自己的接口信息
$appid = 'wxdf3818cd5d31b0b4';
$appsecret = '962677bbd08c9c055ba492557e04876c';
if (empty($code)) $this->error('授权失败');
$token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
$token = json_decode(file_get_contents($token_url));
if (isset($token->errcode)) {
    echo '<h1>错误：</h1>'.$token->errcode;
    echo '<br/><h2>错误信息：</h2>'.$token->errmsg;
    exit;
}
$access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$appid.'&grant_type=refresh_token&refresh_token='.$token->refresh_token;
//转成对象
$access_token = json_decode(file_get_contents($access_token_url));
if (isset($access_token->errcode)) {
    echo '<h1>错误：</h1>'.$access_token->errcode;
    echo '<br/><h2>错误信息：</h2>'.$access_token->errmsg;
    exit;
}
$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.$access_token->openid.'&lang=zh_CN';
//转成对象
$user_info = json_decode(file_get_contents($user_info_url));
if (isset($user_info->errcode)) {
    echo '<h1>错误：</h1>'.$user_info->errcode;
    echo '<br/><h2>错误信息：</h2>'.$user_info->errmsg;
    exit;
}

$rs =  json_decode(json_encode($user_info),true);//返回的json数组转换成array数组

//打印用户信息
echo '<pre>';
print_r($token);
print_r($access_token);
print_r($user_info);
print_r($rs);
echo '</pre>';
header('location:http://www.gongziyu.com');

?>


		
	</div>





	<?php include '../share/footer.php';?>
</body>

</html>