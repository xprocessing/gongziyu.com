<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>二维码生成/微信二维码生成-Powered by公子鱼科技</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../share/default.css">
	<link href="shortcut.png" rel="apple-touch-icon-precomposed">
	<link rel="shortcut icon" href="../shortcut.png" />
	<meta name="baidu-site-verification" content="4JWyKT18Wl" />

	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

	<style>
		input,
		select {
			height: 30px;
			margin: 10px;
			width: 200px;
		}

		button {
			margin: 20px;
			height: 30px;
			padding: 5px 30px;
		}

		main {
			padding: 10px 0px;
			line-height: 2;
		}

		main textarea {
			width: 280px;
		}
	</style>


</head>


<body>
	<?php include '../share/header.php';?>


	<div class="main">

<div class="ProjectLogo"><img src="../assets/qrcode.png" /> </div>




		<ul class="ourProjects">
			<li>
				<div class="projectName">普通二维码生成</div>
				<div class="projectDesc">

					<main>
						<section>

							<img id="qrious" width="250" height="250" src="">
							<form autocomplete="off">

								<div>
									输入要生成二维码的网址或者文字
									<br>

									<!-- <input type="text" name="value" value="http://gongziyu.com" spellcheck="false" class="form-control"> -->

									<textarea rows="3" type="text" name="value" value="http://gongziyu.com" spellcheck="false" class="form-control">http://gongziyu.com</textarea>
								</div>
								<div>
									像素尺寸
									<input type="number" name="size" placeholder="100" min="100" max="1000" value="250">
								</div>
								<div>
									容错等级
									<select name="level">
										<option value="L">L - 7% damage</option>
										<option value="M">M - 15% damage</option>
										<option value="Q">Q - 25% damage</option>
										<option value="H">H - 30% damage</option>
									</select>
								</div>
								<div>
									背景颜色
									<input type="color" name="background" value="#ffffff">
								</div>
								<div>
									条码颜色
									<input type="color" name="foreground" value="#000000">
								</div>
							</form>
						</section>
					</main>
					<script src="qrious.js"></script>
					<script>
						(function() {
							var $background = document.querySelector('main form [name="background"]')
							var $foreground = document.querySelector('main form [name="foreground"]')
							var $level = document.querySelector('main form [name="level"]')
							var $section = document.querySelector('main section')
							var $size = document.querySelector('main form [name="size"]')
							var $value = document.querySelector('main form [name="value"]')

							var qr = window.qr = new QRious({
								element: document.getElementById('qrious'),
								size: 250,
								value: 'http://gongziyu.com'
							})

							$background.addEventListener('change', function() {
								qr.background = $background.value || null
							})

							$foreground.addEventListener('change', function() {
								qr.foreground = $foreground.value || null
							})

							$level.addEventListener('change', function() {
								qr.level = $level.value
							})

							$size.addEventListener('change', function() {
								if (!$size.validity.valid) {
									return
								}

								qr.size = $size.value || null

								$section.style.minWidth = qr.size + 'px'
							})

							$value.addEventListener('input', function() {
								qr.value = $value.value
							})
						})()
					</script>


				</div>

			</li>
			<li>
				<div class="projectName">微信二维码生成</div>
				<div class="projectDesc">
					微信公众号二维码生成，稍等哈

				</div>

			</li>








		</ul>


	</div>















	<?php include '../share/footer.php';?>
</body>

</html>