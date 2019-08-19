<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>hello</title>
<meta id="viewport" name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1; user-scalable=no;">
</head>

<body>
	
	
<?php 

$newcookie = $_POST["newcookie"];

//配置数据库链接
include "../config/database.php";

// 创建连接
$conn = new mysqli( $servername, $username, $password, $dbname );
// Check connection
if ( $conn->connect_error ) {
	die( "连接失败: " . $conn->connect_error );
}

$sql = "UPDATE shoplist SET thecookie = '$newcookie' WHERE shopowner = 'Neo'";


if ($conn->multi_query($sql) === TRUE) {
    echo "数据已更新!",date("Y-m-d H:i:s");
} else {
    echo "<br>Error: " . $sql . "<br>" . $conn->error;
}

echo $newcookie;


$conn->close();



?>


</body>
</html>






