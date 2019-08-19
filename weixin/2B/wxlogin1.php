<?php
//来自https://blog.csdn.net/vailook/article/details/52410945?locationNum=10
//https://open.weixin.qq.com/cgi-bin/showdocument?action=dir_list&t=resource/res_list&verify=1&id=open1419316505&token=bcdca1c5c5f64eb67df5b0433b81847cdb616105&lang=zh_CN

/*
返回  code state
*/

$appid = 'wxdf3818cd5d31b0b4';

$url = "https://open.weixin.qq.com/connect/qrconnect?appid=$appid&redirect_uri=http://gongziyu.com/weixin/2B/wxlogin2.php&response_type=code&scope=snsapi_login&state=1&connect_redirect=1#wechat_redirect";

header('location:'.$url);



?>