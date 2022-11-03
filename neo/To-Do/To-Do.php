<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>一个人要像一支队伍</title>
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>

	<link rel="stylesheet" href="To-Do.css"/>
	<meta id="viewport" name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1; user-scalable=no;">
	<link rel="apple-touch-icon" href="neo100.jpg"/>
	<link href="neo100.jpg" rel="shortcut icon"/>
	<link href="neo100.jpg" rel="Bookmark"/> 
</head>

<body>
	<div class="To-Do-Lists-ALL">
		<div id="NeoGoGoGo"><h3>一个人要像一支队伍</h3></div>
		<div id="timeisall" title="双击全部收起和展开">
		
			<script type="text/javascript">
				//var int = self.setInterval( "clock()", 1000 )

				function clock() {
					var nowtime = new Date();
					document.getElementById( "timeisall" ).innerHTML = nowtime;
				}
			</script>
对着自己的头脑和心灵招兵买马，不气馁，有召唤，爱自由！
		</div>

		<?php

		$doc = new DomDocument;
		$doc->validateOnParse = true;
		$doc->Load( 'new-To-Do.xml' );

		// We retrieve ToDoBigs
		$ToDoLists = $doc->getElementsByTagName( 'To-Do-List' );

		foreach ( $ToDoLists as $ToDoList ) {
			//echo $ToDoList->nodeValue, PHP_EOL;
			foreach ( $ToDoList->childNodes as $ToDoListchildNode ) {
				//To-Do-Big

				if ( $ToDoListchildNode->nodeName == 'To-Do-Big' ) {

					echo '<div class="To-Do-List"><div class="To-Do-Big"><span>' . $ToDoListchildNode->nodeValue . '</span></div><div class="To-Do-small"><ul>';


				}

				//To-Do-Big

				//To-Do-small-li

				if ( $ToDoListchildNode->nodeName == 'To-Do-small' ) {

					// foreach($ToDoListchildNode->childNodes as $smallli)
					foreach ( $ToDoListchildNode->getElementsByTagName( 'To-Do-small-li' ) as $smallli ) {



						if ( $smallli->getAttribute( 'isfinish' ) == "true" ) {

							echo "<li class='isfinish'>";

							echo '<input type="checkbox" checked="checked" ><span>' . $smallli->nodeValue . '</span>';

						} else {
							echo "<li>";

							echo '<input type="checkbox" ><span>' . $smallli->nodeValue . '</span>';
						}

						echo "</li>";

					}

					echo ' </ul> </div> </div>';

				}

				//To-Do-small-li



			}

			//echo $ToDoList->nodeValue, PHP_EOL;


		}



		?>
		<a href="#"><img src="23T-yellow.jpg" width="100%" id="Mustang"></a>
	</div>




	<script>
		$( document ).ready( function () {

			//激活编辑

			$( ".To-Do-List" ).hover( function () {
				//alert( $( this ).text());

				$( "span" ).attr( "contenteditable", "true" );

			} );

			//激活编辑


			//增-删-改 条目
			//$( "li" ).on( "keydown",function ( event ) {
			//这种情况不会操作动态增加后的li，应选择下面这种写法。

			$( "body" ).on( "keydown", "li", function ( event ) {
				console.log( event.type + ": " + event.which );
				console.log( $( this ).find( "span" ).text().length );
				//增加
				if ( event.which == 13 ) {
					//$(this).remove();					
					$( this ).after( '<li><input type="checkbox"><span contenteditable="true">-今天完成</span></li>' );
					$( this ).focusout();
					$( this ).next().find( "span" ).focus();


				}
				//删除
				if ( $( this ).find( "span" ).text().length == 0 ) {
					$( this ).remove();

				}

			} );
			//增-删-改 条目


			//check

			$( "body" ).on( "click", "input", function () {

				if ( $( this ).is( ':checked' ) ) {
					$( this ).parent().addClass( "isfinish" );
				} else {
					$( this ).parent().removeClass( "isfinish" );
				}


			} );



			//check

			//收起放开子列表

			$( "body" ).on( "dblclick", "#timeisall", function () {
				
				$( ".To-Do-small" ).fadeToggle();
				

			} );
			
			
			
			
			
			
			

			$( "body" ).on( "dblclick", ".To-Do-Big", function () {

				$( this ).parent().find( ".To-Do-small" ).fadeToggle();


			} );



			//收起放开子列表
			//初次打开根据时间自动收起放开子列表
			var nowtime = new Date();
			var nowtimehour = nowtime.getHours();
			
			console.log( nowtimehour );

			function findandshow() {


				if ( nowtimehour >= 7 && nowtimehour < 12 ) {

					//$( ".To-Do-small" ).eq( 2 ).fadeToggle();
					$( ".To-Do-Big:contains('上午')" ).parent().find( ".To-Do-small" ).fadeToggle();


				} else if ( nowtimehour >= 12 && nowtimehour < 18 ) {


					//$( ".To-Do-small" ).eq( 3 ).fadeToggle();
					$( ".To-Do-Big:contains('下午')" ).parent().find( ".To-Do-small" ).fadeToggle();



				} else if ( nowtimehour >= 18 && nowtimehour < 23 ) {
					//$( ".To-Do-small" ).eq( 4 ).fadeToggle();
					$( ".To-Do-Big:contains('晚上')" ).parent().find( ".To-Do-small" ).fadeToggle();


				} else if ( nowtimehour >= 23 && nowtimehour < 24 ) {
					$( ".To-Do-small" ).last().fadeToggle();


				} else {

					$( ".To-Do-small" ).first().fadeToggle();

				}

			}
			//$( ".To-Do-small" ).delay( 3000 ).fadeToggle();
			//findandshow();
			//初次打开根据时间自动收起放开子列表，但是我不想让他自动收起了




			//浏览器端整理数据，上传数据

			$( "body" ).on( "click", "#Mustang", function () {

				// var newToDo = $( ".To-Do-Lists-ALL" ).html();

				var newToDoxml = "<To-Do-Lists-ALL>";

				// 遍历.To-Do-List

				$( ".To-Do-List" ).each( function () {

					var ToDoBig = $( this ).find( ".To-Do-Big" ).find( "span" ).text().trim();
					newToDoxml = newToDoxml + '<To-Do-List><To-Do-Big><span>' + ToDoBig + '</span></To-Do-Big><To-Do-small>';

					// 遍历li
					$( this ).find( "li" ).each( function () {


						if ( $( this ).find( "input" ).is( ':checked' ) ) {
							var ToDosmallli = $( this ).find( "span" ).text().trim();
							newToDoxml = newToDoxml + '<To-Do-small-li isfinish="true">' + ToDosmallli + '</To-Do-small-li>';

						} else {

							var ToDosmallli = $( this ).find( "span" ).text().trim();
							newToDoxml = newToDoxml + '<To-Do-small-li isfinish="false">' + ToDosmallli + '</To-Do-small-li>';


						}



					} );
					//遍历li

					newToDoxml = newToDoxml + '</To-Do-small></To-Do-List>';


				} );

				newToDoxml = newToDoxml + '</To-Do-Lists-ALL>';

				console.log( newToDoxml );

				//上传数据newToDoxml

				$.ajax( {
						method: "POST",
						url: "update-todoxml.php",
						data: {
							newToDoxmltext: newToDoxml
						}
					} )
					.done( function ( msg ) {
						alert( "保存" + msg );
					} );


				//上传数据newToDoxml









			} );



			//浏览器端整理数据，上传数据

			//大列表和小项目拖曳操作





			$( ".To-Do-Lists-ALL" ).on( "dragstart", ".To-Do-List", function () {

				this.draggable = "true";

				console.log( "draging" );




			} );

			$( ".To-Do-Lists-ALL" ).on( "dragover", ".To-Do-List", function () {




				console.log( "dragover" );




			} );

			$( ".To-Do-Lists-ALL" ).on( "drop", ".To-Do-List", function () {


				console.log( "drop" );




			} );





			//大列表和小项目拖曳操作

			//自动获得时间安排，到点通知

			function DoNotification() {


				//列出所有包含点的li，用点分割字符，如果时间等于当前小时，发起通知

				$( ".To-Do-small li span:contains('点') " ).each( function () {
					var textcontainsclock = $( this ).text();
					var RegExpresult = textcontainsclock.split( "点" );
					console.log( RegExpresult[ 0 ] );
					console.log( RegExpresult[ 1 ] );

					var nowtime = new Date();
					var nowtimehour = nowtime.getHours();

					console.log( nowtimehour );
					if ( RegExpresult[ 0 ] == nowtimehour ) {

						//启动通知


						if ( window.Notification && Notification.permission !== "denied" ) {
							Notification.requestPermission( function ( status ) { // 请求权限
								if ( status === 'granted' ) {
									// 弹出一个通知
									var n = new Notification( RegExpresult[ 0 ] + "点", {
										body: RegExpresult[ 1 ],
										icon: 'neo100.jpg'
									} );
									// 两秒后关闭通知
									setTimeout( function () {
										n.close();
									}, 5000 );
								}
							} );
						}


						//启动通知



					}

				} );


				//列出所有包含点的li，用点分割字符，如果时间等于当前小时，发起通知



			}

			DoNotification(); //第一次加载通知

			//每20分钟运行一次通知
			//setInterval( "$().DoNotification()", 10000 );
			//上面这个方法会报错。使用下面的方法

			$( function () {
				//DoNotification(); 
				setInterval( DoNotification, 1200000 ); // 注意函数名没有引号和括弧！
				// 在jquery使用setInterval

			} );

			//自动获得时间安排，到点通知








		} );
	</script>





</body>

</html>