<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>淘口令解析/淘口令生成-Powered by公子鱼科技</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../share/default.css">
	<link href="shortcut.png" rel="apple-touch-icon-precomposed">
	<link rel="shortcut icon" href="../shortcut.png" />
	<meta name="baidu-site-verification" content="4JWyKT18Wl" />

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

	<style>
		input {
			height: 30px;
			margin: 10px;
			width: 200px;
		}

		
	</style>


</head>


<body>
	<?php include '../share/header.php';?>


	<div class="main">


<div class="ProjectLogo"><img src="../assets/taokouling.png" /> </div>




		<ul class="ourProjects">
			<li>
				<div class="projectName">淘口令解析</div>
				<div class="projectDesc">
					<form>

						<div>输入口令：
							<input type="text" name="kouling" class="kouling" value="￥解析口令￥">
						</div>

						<div>解密结果：
							<input type="text" name="koulingneirong" class="koulingneirong" value="">
						</div>

					</form>
					<button type="button" class="jiemikouling neoButton">解析口令</button>


				</div>

			</li>
			<li>
				<div class="projectName">淘口令创建</div>
				<div class="projectDesc">
					<form>

						<div>输入链接：
							<input type="text" name="" class="url2kouling" value="https://gongziyu-tech.taobao.com">
						</div>

						<div>生成口令：
							<input type="text" name="" class="koulingresult" value="">
						</div>

					</form>
					<button type="button" class="shengchengkouling neoButton">生成口令</button>

				</div>

			</li>








		</ul>


	</div>





	<script>
		$(document).ready(function() {
			$(".jiemikouling").click(function() {

				var kouling = $(".kouling").val();

				$.getJSON("tpwd.php", {
						kouling: kouling,
						bywho: "Neo"
					})
					.done(function(data) {
						//alert("Data Loaded: " + data);
						$(".koulingneirong").attr("value", data.url);
					});




			});
			$(".shengchengkouling").click(function() {

				//var url2kouling = $(".url2kouling").attr("value");
				var url2kouling = $(".url2kouling").val();

				$.getJSON("tpwd-create.php", {
						url2kouling: url2kouling,
						bywho: "Neo"
					})
					.done(function(data) {
						//alert("Data Loaded: " + data);
						$(".koulingresult").attr("value", data.model);
					});




			});






		});
	</script>










	<?php include '../share/footer.php';?>
</body>

</html>