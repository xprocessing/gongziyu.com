{"today":<?php
//搞到当前日期
$datenow = date( "Y-m-d" );
//echo $datenow;
//搞到昨天日期
$dateyesterday = date( "Y-m-d", strtotime( "-1 day" ) );
//echo $dateyesterday;
$everyHourData = array();
//配置数据库链接
include "../config/database.php";

// 创建连接
$conn = new mysqli( $servername, $username, $password, $dbname );
// Check connection
if ( $conn->connect_error ) {
	die( "连接失败: " . $conn->connect_error );
}

$sql = "SELECT * FROM item567106111962 WHERE thedate = '$datenow'";

$result = $conn->query( $sql );

while($row = mysqli_fetch_array($result))
{
	
	
	$Hour00Data = abs($row['hour00']);
	$Hour01Data = abs($row['hour00']-$row['hour01']);
	$Hour02Data = abs($row['hour01']-$row['hour02']);
	$Hour03Data = abs($row['hour02']-$row['hour03']);
	$Hour04Data = abs($row['hour03']-$row['hour04']);
	$Hour05Data = abs($row['hour04']-$row['hour05']);
	$Hour06Data = abs($row['hour05']-$row['hour06']);
	$Hour07Data = abs($row['hour06']-$row['hour07']);
	$Hour08Data = abs($row['hour07']-$row['hour08']);
	$Hour09Data = abs($row['hour08']-$row['hour09']);
	$Hour10Data = abs($row['hour09']-$row['hour10']);
	$Hour11Data = abs($row['hour10']-$row['hour11']);
	$Hour12Data = abs($row['hour11']-$row['hour12']);
	$Hour13Data = abs($row['hour12']-$row['hour13']);
	$Hour14Data = abs($row['hour13']-$row['hour14']);
	$Hour15Data = abs($row['hour14']-$row['hour15']);
	$Hour16Data = abs($row['hour15']-$row['hour16']);
	$Hour17Data = abs($row['hour16']-$row['hour17']);
	$Hour18Data = abs($row['hour17']-$row['hour18']);
	$Hour19Data = abs($row['hour18']-$row['hour19']);
	$Hour20Data = abs($row['hour19']-$row['hour20']);
	$Hour21Data = abs($row['hour20']-$row['hour21']);
	$Hour22Data = abs($row['hour21']-$row['hour22']);
	$Hour23Data = abs($row['hour22']-$row['hour23']);
	
	
	
    $everyHourData = array($Hour00Data,$Hour01Data,$Hour02Data,$Hour03Data,$Hour04Data,$Hour05Data,$Hour06Data,$Hour07Data,$Hour08Data,$Hour09Data,$Hour10Data,$Hour11Data,$Hour12Data,$Hour13Data,$Hour14Data,$Hour15Data,$Hour16Data,$Hour17Data,$Hour18Data,$Hour19Data,$Hour20Data,$Hour21Data,$Hour22Data,$Hour23Data);
	$hournow = date('H');
	$hournow +=1;
	$everyHourData[$hournow]=0;
	
	$everyHourData2json =   json_encode($everyHourData);
    echo $everyHourData2json;
	
}


$conn->close();


?>
,"yesterday":<?php
//搞到当前日期
$datenow = date( "Y-m-d" );
//echo $datenow;
//搞到昨天日期
$dateyesterday = date( "Y-m-d", strtotime( "-1 day" ) );
//echo $dateyesterday;
$everyHourData = array();


// 创建连接
$conn = new mysqli( $servername, $username, $password, $dbname );
// Check connection
if ( $conn->connect_error ) {
	die( "连接失败: " . $conn->connect_error );
}

$sql = "SELECT * FROM item567106111962 WHERE thedate = '$dateyesterday'";

$result = $conn->query( $sql );

while($row = mysqli_fetch_array($result))
{
	
	
	$Hour00Data = abs($row['hour00']);
	$Hour01Data = abs($row['hour00']-$row['hour01']);
	$Hour02Data = abs($row['hour01']-$row['hour02']);
	$Hour03Data = abs($row['hour02']-$row['hour03']);
	$Hour04Data = abs($row['hour03']-$row['hour04']);
	$Hour05Data = abs($row['hour04']-$row['hour05']);
	$Hour06Data = abs($row['hour05']-$row['hour06']);
	$Hour07Data = abs($row['hour06']-$row['hour07']);
	$Hour08Data = abs($row['hour07']-$row['hour08']);
	$Hour09Data = abs($row['hour08']-$row['hour09']);
	$Hour10Data = abs($row['hour09']-$row['hour10']);
	$Hour11Data = abs($row['hour10']-$row['hour11']);
	$Hour12Data = abs($row['hour11']-$row['hour12']);
	$Hour13Data = abs($row['hour12']-$row['hour13']);
	$Hour14Data = abs($row['hour13']-$row['hour14']);
	$Hour15Data = abs($row['hour14']-$row['hour15']);
	$Hour16Data = abs($row['hour15']-$row['hour16']);
	$Hour17Data = abs($row['hour16']-$row['hour17']);
	$Hour18Data = abs($row['hour17']-$row['hour18']);
	$Hour19Data = abs($row['hour18']-$row['hour19']);
	$Hour20Data = abs($row['hour19']-$row['hour20']);
	$Hour21Data = abs($row['hour20']-$row['hour21']);
	$Hour22Data = abs($row['hour21']-$row['hour22']);
	$Hour23Data = abs($row['hour22']-$row['hour23']);
	
	
	
    $everyHourData = array($Hour00Data,$Hour01Data,$Hour02Data,$Hour03Data,$Hour04Data,$Hour05Data,$Hour06Data,$Hour07Data,$Hour08Data,$Hour09Data,$Hour10Data,$Hour11Data,$Hour12Data,$Hour13Data,$Hour14Data,$Hour15Data,$Hour16Data,$Hour17Data,$Hour18Data,$Hour19Data,$Hour20Data,$Hour21Data,$Hour22Data,$Hour23Data);
		
	$everyHourData2json =   json_encode($everyHourData);
    echo $everyHourData2json;
}
$conn->close();?>
	
}