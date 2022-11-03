<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>宝贝手淘搜索分时流量-公子鱼科技提供技术驱动</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<!-- 引入 echarts.js -->
<script src="js/echarts.min.js"></script>
<!-- 引入 vintage 主题 -->
<script src="js/walden.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<style>
 .flex-container-01 {
            display: -webkit-flex;
            display: flex;
            width: 100%;
            height: 400px;
            background-color: sliver;
        }

        .flex-lists-01-item {
            
            border: 1px solid #999;
            box-sizing: border-box;
            padding: 5px;
            margin: 3px;;
        }

        .flex-lists-01-item.item-01 {
            flex: auto;
        }

        .flex-lists-01-item.item-02 {
            flex: initial;
            width: 200px;
        }

      

</style>
	
</head>

<body>
<?php  file_get_contents('http://gongziyu.com/neo/taobao/sycm.php'); ?>
	


 <div class="flex-container-01">
	  <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
        <div class="flex-lists-01-item item-01"><div id="chart-01" style="width: 100%;height:400px;"></div></div>
        <div class="flex-lists-01-item item-02">
		<div>昨天订单量：xxx单</div>
		<div>今日此刻补单量：xxx单</div>
		<div>今日此刻订单量：xxx单</div>
		<div>今日此刻宝贝转化率：8%</div>
		<div>初期建议：保持1.5倍增长</div>
		<div>打开生意参谋看明细</div>
		


		</div>
        
    </div>




	
	



    <script type="text/javascript">
        var myChart = echarts.init(document.getElementById('chart-01'),'walden');
      
$.get( "sycmdataout.php", function( uvdata ) {
  
  //$( "body" ).append( "今天: " + uvdata.today );
  //$( "body" ).append( "昨天: " + uvdata.yesterday );

myChart.setOption({
      
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            crossStyle: {
                color: '#999'
            }
        }
    },
    toolbox: {
        feature: {
            dataView: {show: true, readOnly: false},
            magicType: {show: true, type: ['line', 'bar']},
            restore: {show: true},
            saveAsImage: {show: true}
        }
    },
    legend: {
        data:['今天手淘搜索','昨天手淘搜索','今日转化率']
    },
    xAxis: [
        {
            type: 'category',
            data: ['0点','1点','2点','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23点'],
            axisPointer: {
                type: 'shadow'
            }
        }
    ],
    yAxis: [
        {
            type: 'value',
            name: '手淘访客',           
            axisLabel: {
                formatter: 'uv：{value}'
            }
        },
        {
            type: 'value',
            name: '转化率',
            axisLabel: {
                formatter: '{value} %'
            }
        }
    ],
    series: [
        {
            name:'今天手淘搜索',
            type:'bar',
            data:uvdata.today
        },
        {
            name:'昨天手淘搜索',
            type:'bar',
            data:uvdata.yesterday
        },
        {
            name:'今日转化率',
            type:'line',
            yAxisIndex: 1,
            data:[2.0, 2.2, 3.3, 4.5, 6.3, 5.2, 5.3, 8.4, 4.0, 4, 4, 4]
        }
    ]



    });


}, "json" );

        // 基于准备好的dom，初始化echarts实例




    
       
    </script>	


	
	
	
	
	
	<div style="padding: 20px 5%; text-align:center; line-height:2;">
	<form action="updatecookie.php" method="post" >


请每天更新cookies，否则无法系统无法自动获得数据。

<textarea name="newcookie" wrap="hard" style="width: 100%;height:100px;"></textarea>
<br>
<input type="submit" value="提交" style="width: 10%;height:50px;">
</form> 

	
	<div>cookies获得书签栏工具：<a href='javascript: void ((function () { var cookieData = document.cookie; if(window.clipboardData){ window.clipboardData.setData("Text", cookieData); alert("cookie已经复制到粘贴板，去粘贴吧"); } else { prompt("请右击复制下面cookies文本，确定后去粘贴提交。",cookieData); } })())'>拿到新cookies</a></div>	
	<div>如何使用：把它拖到浏览器书签栏，打开生意参谋-流量-商品来源，点击书签即可。</div>
	
</div>
	
	
	
	
	


	
</body>

</html>



