<html>

<head>
    <meta charset="UTF-8">
    <title>easy_sql</title>
</head>

<body>
  <h1>sqlmap是没有灵魂的</h1>
<form method="get">
    姿势: <input type="text" name="inject" value="1">
    <input type="submit">
</form>

<pre>
<?php
//function waf1($inject) {
//    preg_match("/select|update|delete|drop|insert|where|\./i",$inject) && die('return preg_match("/select|update|delete|drop|insert|where|\./i",$inject);');
//}

//function waf2($inject) {
//    strstr($inject, "set") && strstr($inject, "prepare") && die('strstr($inject, "set") && strstr($inject, "prepare")');
//}

if(isset($_GET['inject'])) {
    $id = $_GET['inject'];
//    waf1($id);
//    waf2($id);
    $mysqli = new mysqli("127.0.0.1","root","root","supersqli");
    //多条sql语句
    $sql = "select * from `words` where id = '$id';";
    echo "当前执行语句：".$sql."<br><hr>";
    if (!$result = $mysqli->query($sql)) {
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if ($result->num_rows === 0) {
        echo "We could not find a match for ID $id, sorry about that. Please try again.";
        exit;
    }
    echo "var_dump(\$mysqli->query($sql))):";
    var_dump($result);
    echo "<br>";

//    $res = $mysqli->multi_query($sql);

//    if ($res){//使用multi_query()执行一条或多条sql语句
//      do{
//        if ($rs = $mysqli->store_result()){//store_result()方法获取第一条sql语句查询结果
//          while ($row = $rs->fetch_row()){
//            var_dump($row);
//            echo "<br>";
//          }
//          $rs->Close(); //关闭结果集
//          if ($mysqli->more_results()){  //判断是否还有更多结果集
//            echo "<hr>";
//          }
//        }
//      }while($mysqli->next_result()); //next_result()方法获取下一结果集，返回bool值
//    } else {
//      echo "error ".$mysqli->errno." : ".$mysqli->error;
//    }
    $mysqli->close();  //关闭数据库连接
}


?>
</pre>

</body>

</html>
