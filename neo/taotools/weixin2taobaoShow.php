<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>点击购买，复制口令，打开手机淘宝购买</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="shortcut.png" rel="apple-touch-icon-precomposed">

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

	<script src="https://unpkg.com/clipboard@2.0.0/dist/clipboard.min.js"></script>

	<style>

.content{width:100%;margin:0 auto;position:relative;}

.itemmaininfor{width:100%;line-height:2;font-size:18px;}
.itemmaininfor .item-pic img{width:100%;}
.itemmaininfor .reserve_price{text-decoration: line-through;}
.itemmaininfor .final_price{color:#FF0036;font-size:24px;font-weight:bold;}


.itemdesc{width:100%;overflow:hidden;}
.itemdesc img{width:100%;}
#buyitnowcode{width:100%;}
.buyitnow{width:100%;line-height:3;bottom:10px;background-color:#FF0036;color:#fff;text-align:center;}

	</style>


</head>


<body>

<div class="content">

<div class="itemmaininfor">
<div class="item-pic"><img src="" ></div>
<div class="item-title">标题</div>
<div class="item-price">促销价:<span class="final_price"></span>原价:<span class="reserve_price"></span></div>
</div>
<textarea id="buyitnowcode"></textarea>

<div class="buyitnow btn" data-clipboard-action="copy" data-clipboard-target="#buyitnowcode">复制口令，去淘宝购买</div>
<div class="itemdesc"></div>



</div>

	<script>
new ClipboardJS('.btn');
		$(document).ready(function() {



            ///输出主图标题价格等信息
			var getmaininforurl="<?php echo 'http://gongziyu.com/taotools/weixin2taobaoService.php?id=' . $_GET["id"]; ?>"

$.getJSON(getmaininforurl)
	.done(function(data) {
		console.log(data);
		//循环
		$(".item-pic img").attr("src", data.results.n_tbk_item.pict_url);
		$(".item-title").html(data.results.n_tbk_item.title);
		$(".reserve_price").html(data.results.n_tbk_item.reserve_price);
		$(".final_price").html(data.results.n_tbk_item.zk_final_price);


		//输出







	});



            ///输出主图标题价格等信息





			///输出宝贝详情


				var getdescurl="<?php echo 'http://gongziyu.com/taotools/weixin2taobaoService.2.php?id=' . $_GET["id"]; ?>"

				$.getJSON(getdescurl)
					.done(function(data) {
						console.log(data);
						//data.data.wdescContent.pages.forEach
						//循环输出详情图片
						var descimglist = data.data.wdescContent.pages;

						var newDesc;
						for (var k = 0; k < descimglist.length ; k++) {
							var newDesctemp = '<img src=http://img'+ descimglist[k].match(/img(\S*)jpg/)[1] +'jpg >';
							newDesc+=newDesctemp;

						}
						$(".itemdesc").html(newDesc);


						//循环输出详情图片







					});
			///输出宝贝详情

			///弹出口令让用户复制-start



var url2kouling = "<?php echo 'http://gongziyu.com/taotools/weixin2taobaoService.3.php?id=' . $_GET["id"]; ?>"

$.getJSON(url2kouling)
	.done(function(data) {
		console.log(data);

		$("#buyitnowcode").html("优惠口令："+data.data.couponLinkTaoToken+"，点击复制用手机淘宝查看");


	});





			///弹出口令让用户复制-end











		});
	</script>











</body>

</html>