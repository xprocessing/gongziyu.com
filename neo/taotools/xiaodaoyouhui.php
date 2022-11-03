<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>小道优惠查询-公子鱼科技</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../share/default.css">
	<link href="shortcut.png" rel="apple-touch-icon-precomposed">
	<link rel="shortcut icon" href="../shortcut.png" />
	<meta name="baidu-site-verification" content="4JWyKT18Wl" />

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

	<style>
	.main{width:100%; margin:0 auto;line-height:3;text-align:center;}
	.main input{width:70%;line-height:2;padding:10px;margin:10px;box-shadow: 0px 0px 5px green  ;}
	.main .getxiaodaoyouhui{line-height:2;padding:10px 30px;;margin:10px;border:1px solid #fff;border-radius:4px; background-color: #4CAF50; color: white;}
	.main .getxiaodaoyouhui:hover{cursor:pointer;}
	</style>


</head>


<body>
	<?php include '../share/header.php';?>


	<div class="main">

<div class="ProjectLogo"><img src="../assets/xiaodaoyouhui.png" /> </div>

			<div><h2>放入淘宝商品微信分享口令</h2></div>

			<div><input type="text" name="sharekouling" class="sharekouling" value=""></div>

			<div><button type="button" class="getxiaodaoyouhui"">小道优惠查询</button></div>
			<div><input type="text" name="youhuikongling" class="youhuikongling" value=""></div>

<br>
<br>
<br>
<br>
<br>







	</div>

<script>
	$(".getxiaodaoyouhui").click(function() {

//var url2kouling = $(".url2kouling").attr("value");
var sharekouling = $(".sharekouling").val();

$.getJSON("xiaodaoyouhui-io.php", {
		kouling: sharekouling,
		bywho: "Neo"
	})
	.done(function(data) {
		//alert("Data Loaded: " + data);
		if(data.coupon_amount){
			$(".youhuikongling").attr("value", "查到小道优惠券:"+data.coupon_amount+"元,复制口令："+data.finaleKouling+"用手机淘宝打开");

		} else{

$(".youhuikongling").attr("value", "非常遗憾，该商品没有查到有小道优惠。");
		}
	});




});

</script>












	<?php include '../share/footer.php';?>
</body>

</html>