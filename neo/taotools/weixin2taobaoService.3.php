<?php

//爬数据
header( "Content-type:text/html;Charset=utf8" );
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, 'https://pub.alimama.com/common/code/getAuctionCode.json?adzoneid=19337200068&siteid=55850461&scenes=1&tkFinalCampaign=20&_tb_token_=7e5b6ae3a3be3&auctionid=' . $_GET["id"] );
$thecookie="t=b736d49886aebe7e86bbf0f1ef5e2a41; cna=lhzcE/EhOx4CAX12YbaXTEFJ; account-path-guide-s1=true; 98923130_yxjh-filter-1=true; cookie2=1158ff4d58c1d24569ccaa7af253f9df; v=0; _tb_token_=7e5b6ae3a3be3; alimamapwag=TW96aWxsYS81LjAgKFdpbmRvd3MgTlQgNi4xOyBXT1c2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzY4LjAuMzQ0MC4xMDYgU2FmYXJpLzUzNy4zNg%3D%3D; cookie32=def58b095cfe9a7fbc728ee1be7a19f5; alimamapw=HXoAFnV3ESYPHHdRFiAHFSAKHXp%2FFncDESB7HHEhOlQBVFEPWQ8OA1YAA1sKWlVSUFcDA1ZbCQ8I%0AVQAEUAda; cookie31=OTg5MjMxMzAsJUU1JTg1JUFDJUU1JUFEJTkwJUU5JUIxJUJDJUU3JUE3JTkxJUU2JThBJTgwLGdvbmd6aXl1QGdvbmd6aXl1LmNvbSxUQg%3D%3D; JSESSIONID=663241A1851FA9ADEE8D062B59B82A84; login=U%2BGCWk%2F75gdr5Q%3D%3D; taokeisb2c=; rurl=aHR0cHM6Ly9wdWIuYWxpbWFtYS5jb20vP3NwbT1hMjMyMC43Mzg4NzgxLmEyMTR0cjguZDAwNi42ZjM3MjAzMEM5WGxFVQ%3D%3D; apush9642bcb3f0a3a62d7eb7ea773a7a8870=%7B%22ts%22%3A1535792017800%2C%22heir%22%3A1535791935915%2C%22parentId%22%3A1535791718801%7D; isg=BMfHO71YUNS2Q9SHuLnTEiwZVntRZJpNtNyhv5mxSNZ_CMXKp5-y_HGuroDz4HMm";
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


