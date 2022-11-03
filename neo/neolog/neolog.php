<?php
header("Content-type: text/html; charset=utf-8");
//流程：传递参数：时间，数据源请求页面，访问者ip，输入数据，输出数据，
//流程：链接数据，并录入输入数据
//流程：

//配置数据库链接
include "../../config/database.php";

class neolog
{
    /* 成员变量 */
    public $theTime;
    public $fromPage;
    public $userIp;
    public $dataIn;
    public $dataOut;

    /* set数据 */
    public function setLogData($fromPage, $dataIn, $dataOut)
    {
        $this->theTime = date("Y-m-d H:i:s");
        $this->fromPage = $fromPage;
        $this->userIp = $_SERVER["REMOTE_ADDR"];
        $this->dataIn = $dataIn;
        $this->dataOut = $dataOut;

    }

    /* 数据库更新 */
    public function AddLogData()
    {
        // 创建链接

        $conn = new mysqli(servername, username, password, dbname);
        // 检查链接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        //增加数据
        $sql = "INSERT INTO neolog (theTime, fromPage, dataIn , dataOut,userIp)
VALUES ('$this->theTime', '$this->fromPage', '$this->dataIn','$this->dataOut','$this->userIp')";

        if ($conn->query($sql) === true) {
           // echo "新记录插入成功";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

    }

    /* 数据库输出 */
    public function ShowLogData()
    {

        // 创建链接

        $conn = new mysqli(servername, username, password, dbname);
        // 检查链接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        //查询cookie 时间倒序，返回前10个
        $theLogDataSql = "SELECT * FROM neolog ORDER BY theTime Desc LIMIT 10";
        $result = mysqli_query($conn, $theLogDataSql);
        $rowcount = mysqli_num_rows($result);
        //echo $rowcount . "行";
        $allRow = array();
        //mysqli_fetch_array(result,resulttype);
        //MYSQLI_ASSOC,MYSQLI_NUM,MYSQLI_BOTH
        while ($row = mysqli_fetch_array($result)) {
            //echo $row;
            
            array_push($allRow,$row);
            
        }
        echo json_encode($allRow);
        //echo json_encode($resultarray);
        $conn->close();

    }

}

///test 测试

$newlog = new neolog;
$newlog->setLogData('nelog.php', 'hello data in', 'hello data out');
$newlog->AddLogData();
$newlog->ShowLogData();
