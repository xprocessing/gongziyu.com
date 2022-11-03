<?php

//爬数据
header( "Content-type:text/html;Charset=utf8" );
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, 'http://api.m.taobao.com/h5/mtop.taobao.detail.getdesc/6.0/?api=mtop.taobao.detail.getdesc&v=6.0&type=jsonp&dataType=jsonp&timeout=20000&callback=&data=%7B%22id%22%3A%22' . $_GET["id"] . '%22%2C%22type%22%3A%220%22%2C%22f%22%3A%22TB1z0SABsuYBuNkSmRy8qwA3pla%22%7D' );

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


