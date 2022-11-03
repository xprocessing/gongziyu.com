<?php

$newToDo = $_POST["newToDoxmltext"];
$xmlData =$newToDo;
$xmlDoc =  new DOMDocument('1.0');
$xmlDoc->preserveWhiteSpace = false;
$xmlDoc->formatOutput = true;
$xmlDoc->loadXML("<ok>下面的会覆盖我</ok>");
$xmlDoc->loadXML($xmlData);
$xmlDoc->saveXML();
$xmlDoc->save("new-To-Do.xml");


if ($newToDo)
{
$response="成功，好好干！我很看好你！";
	
}
else
{
$response="失败，稍后再试！";
}

//output the response
echo $response;


?>