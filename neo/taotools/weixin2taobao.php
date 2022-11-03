<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>微信跳淘宝-微信里面直接看淘宝商品-Powered by公子鱼科技</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../share/default.css">
	<link href="shortcut.png" rel="apple-touch-icon-precomposed">
	<link rel="shortcut icon" href="../shortcut.png" />
	<meta name="baidu-site-verification" content="4JWyKT18Wl" />

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

	<style>
	.main{width:100%; margin:0 auto;line-height:3;text-align:center;}
	.main input{width:70%;line-height:2;padding:10px;margin:10px;box-shadow: 0px 0px 5px green  ;}
	.main .taobao2weixincreat{line-height:2;padding:10px 30px;margin:10px;border:1px solid #fff;border-radius:4px; background-color: #4CAF50; color: white;}
	.main .taobao2weixincreat:hover{cursor:pointer;}
	</style>


</head>


<body>
	<?php include '../share/header.php';?>


	<div class="main">
	
	<div class="ProjectLogo"><img src="../assets/weixin2taobao.png" /> </div>

			<div><h2>放入淘宝商品连接</h2></div>
			<div>(目前仅支持天猫店铺淘宝客推广的商品)</div>
			<div><input type="text" name="taobaolink" class="taobaolink" value=""></div>		

			<div><button type="button" class="taobao2weixincreat">生成微信可打开连接</button></div>
			<div><input type="text" name="weixinlink" class="weixinlink" value=""></div>
			
            <div><a href="" class="testlink">点击打开测试生成的链接</a></div>
		
		




	</div>

<script>
$( ".taobao2weixincreat" ).click(function() {

  $( this ).fadeOut().fadeIn();

  var taobaolink = $( ".taobaolink" ).val();
  var weixinlink = "http://gongziyu.com/taotools/weixin2taobaoShow.php?id="+ taobaolink.match(/id=(\S*)&/)[1];

  $( ".weixinlink" ).attr( "value", weixinlink  );
  $( ".testlink" ).attr( "href", weixinlink  );


});
</script>












	<?php include '../share/footer.php';?>
</body>

</html>