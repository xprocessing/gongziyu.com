<?php
//配置数据库链接
include "../config/database.php";

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


$thecookie = 't=fd53f2927cb58ffc2104ef093fdefd11; cna=bSciE3omqSYCAXPYZth7S9PQ; thw=cn; UM_distinctid=161f019d60e144-0389ee4cacbe4-b353461-232800-161f019d60f3bb; hng=CN%7Czh-CN%7CCNY%7C156; tg=0; miid=7252011662141849858; l=AoaGaVFi2iKreIlbyvt5uJOFVnYIkcqh; enc=BaPcD2rJ8EQkJj4z2phUKXnZxDb96Zn3ENyKvr9nSeJ5if8Es3AYSQQevsO3BfYzY597kuOX11kS09m2bhxXtQ%3D%3D; tracknick=%5Cu4FDE%5Cu5146%5Cu6797%5Cu946B%5Cu8FC5%5Cu9500%5Cu4E13%5Cu5356%5Cu5E97; lgc=%5Cu4FDE%5Cu5146%5Cu6797%5Cu946B%5Cu8FC5%5Cu9500%5Cu4E13%5Cu5356%5Cu5E97; cookie2=1095c6ce1c8c4c95ab630bce11ff5144; v=0; _tb_token_=e018e535b5e7e; unb=2091404236; sg=%E5%BA%9764; _l_g_=Ug%3D%3D; cookie1=B0b6zKKDl8dbJx2KdJ07JQoC70lfvPwO3mOucSvASPo%3D; dnk=%5Cu4FDE%5Cu5146%5Cu6797%5Cu946B%5Cu8FC5%5Cu9500%5Cu4E13%5Cu5356%5Cu5E97; _nk_=%5Cu4FDE%5Cu5146%5Cu6797%5Cu946B%5Cu8FC5%5Cu9500%5Cu4E13%5Cu5356%5Cu5E97; cookie17=UUjYFkf1UCMHxA%3D%3D; flow_version=new; _euacm_ac_l_uid_=2091404236; 2091404236_euacm_ac_c_uid_=2091404236; _euacm_ac_v_md_=s; uc1=cookie16=UIHiLt3xCS3yM2h4eKHS9lpEOw%3D%3D&tmb=1&cookie21=Vq8l%2BKCLiv0MzbofZcqtsg%3D%3D&cookie15=V32FPkk%2Fw0dUvg%3D%3D&existShop=true&pas=0&cookie14=UoTfKjFboEHw%2Bg%3D%3D&tag=8&lng=zh_CN; skt=50790d336180869b; csg=f503b693; uc3=vt3=F8dBzrhHmN6lZ%2F%2BvdIk%3D&id2=UUjYFkf1UCMHxA%3D%3D&nk2=sGHK%2FpmJlRg88du%2F7h9UqooJ&lg2=W5iHLLyFOGW7aA%3D%3D; existShop=MTUzMTU2MDQ3MA%3D%3D; _cc_=WqG3DMC9EA%3D%3D; mt=ci=0_1&np=; _euacm_ac_c_uid_=2091404236; _euacm_ac_rs_uid_=2091404236; 2091404236_euacm_ac_rs_uid_=2091404236; _euacm_ac_rs_sid_=110765191; _portal_version_=new; isg=BOfn3urNcLfHRfRTjtdbQOXgdhtxxLpMqbcih7lVDXaaqAVqwDwont_pzuCTQJPG';

//$thecookie = $resultarray[ 'thecookie' ];
$conn->close();
echo $thecookie;

//查询cookie


//搞到当前日期
$datenow = date( "Y-m-d" );
//echo $datenow;

//搞到当前小时
$hournow = date( "H" );
//echo $hournow;
$hournowdatacol = "hour" . strval( $hournow );
//echo $hournowdatacol;


//爬数据
header( "Content-type:text/html;Charset=utf8" );
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, 'https://sycm.taobao.com/flow/new/live/item/source.json?dateRange=' . $datenow . '|' . $datenow . '&dateType=today&device=2&itemId=567106111962&order=desc&orderBy=uv' );

//$header = array();  
//curl_setopt($ch,CURLOPT_POST,true);  
//curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);  
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
//curl_setopt($ch,CURLOPT_HEADER,true);  
//curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );

curl_setopt( $ch, CURLOPT_COOKIE, $thecookie );


$content = curl_exec( $ch );
echo $content;


$searchuv;
$content2json = json_decode( $content );
//var_dump ($content2json);
//echo $content2json->{'data'}->{'data'};
//搞到目前搜索数据
foreach ( $content2json->{'data'}->{'data'} as $listuvs ) {

	if ( $listuvs->{'pageName'}->{'value'} == "手淘搜索" ) {
		$searchuv = $listuvs->{'uv'}->{'value'};
		echo "宝贝567106111962目前手淘搜索UV：", $listuvs->{'uv'}->{'value'};
	}

}
//数据库更新 http://www.runoob.com/php/php-mysql-select.html
// 创建链接
$conn = new mysqli( $servername, $username, $password, $dbname );
// 检查链接
if ( $conn->connect_error ) {
	die( "连接失败: " . $conn->connect_error );
}


$sqldatenow = "INSERT INTO item567106111962 (thedate) VALUES ('$datenow');";
//$sql = "INSERT INTO item567106111962 (thedate) VALUES ('$datenow');";
$sqlupdate .= "UPDATE item567106111962 SET $hournowdatacol = $searchuv WHERE thedate = '$datenow'";
if ( $conn->multi_query( $sqldatenow ) === TRUE ) {
	echo "<br>新的一天开始";
} else {
	//echo "Error: " . $sql1 . "<br>" . $conn->error;
	echo "<br>把握好每一天!";
}

if ( $conn->multi_query( $sqlupdate ) === TRUE ) {
	echo "数据已更新!", date( "Y-m-d H:i:s" );
} else {
	echo "<br>Error: " . $sqlupdate . "<br>" . $conn->error;
}

$conn->close();
//数据库更新









?>