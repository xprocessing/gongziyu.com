<?php 

if($_POST["name"]){
    setcookie("user", $_POST["name"], time()+360000);
    header("location:index.php");
    ///这个地方应该跳转到来源网址才对呀
}



if ($_COOKIE["user"]!="Neo")
{
    echo '<form action="NeoOnly.php" method="post">
   <input type="text" name="name" />
    <input type="submit" value="验证身份" />
    </form>';
   die("Powered by Neo，The PSW is Neo！");

}

else
{
   
    header("location:index.php");

    
   
    

}


?>