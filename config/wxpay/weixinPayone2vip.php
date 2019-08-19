<?php
header("Content-type: text/html; charset=utf-8");
//微信支付单文件版 https://github.com/dedemao/weixinPay
//裂变红包：https://www.jb51.net/article/75922.htm
//https://www.jb51.net/article/142036.htm
//微信支付https://segmentfault.com/a/1190000012116639
//微信支付：http://www.php.cn/php-weizijiaocheng-376890.html
//https://www.jb51.net/article/138273.htm
//测试给自己转1块钱
//商户号：1510223641
//公众账号appid：wx7159d3df9cfb4c0e
//用户openid：oOUorwaxNyYIriA4FUUcLhaQSbMs
//资金授权商户号：1510223641
//api密钥：gongziyu0709gongziyu0709gongziyu
//121.42.135.19 (阿里云服务器)


/*测试微信企业给个人发红包*/

require 'wxpayclass.php';

$wxhongbao=new \WXHongBao();
//需要发放的openid 金额 openid 根据微信提供的接口获取，金额根据自己需求
$user_openid="oOUorwaxNyYIriA4FUUcLhaQSbMs";
$pay_money="1.01";
$wxhongbao->newhb($user_openid, $pay_money*100);
$wxhongbao->setActName("gongziyu");
$wxhongbao->setWishing("hello");
$wxhongbao->setRemark("test");
$wxhongbao->send();

echo "ok";
echo $_SERVER['SERVER_ADDR'];
    
?>