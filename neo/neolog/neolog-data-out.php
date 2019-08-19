<?php

//配置数据库链接
include "../config/database.php";
echo $servername;
// 创建链接
$conn = new mysqli( $servername, $username, $password, $dbname );
// 检查链接
if ( $conn->connect_error ) {
	die( "连接失败: " . $conn->connect_error );
}

//查询cookie
$sqlgetthecookie = "SELECT * FROM shoplist WHERE shopowner = 'Neo'";
$result = $conn->query( $sqlgetthecookie );
$resultarray = mysqli_fetch_array( $result );

$thecookie = $resultarray[ 'thecookie' ];
$conn->close();
echo $thecookie;












?>