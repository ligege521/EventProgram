<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $con = new mysqli("localhost","root","","day");
        if(empty($con)){
            die("连接失败");
        }

        function str_kong($str,$name){
            if(strlen($str)==0){
                echo "<script>alert('".$name."不能为空');window.history.back();</script>";
                die();
            }
        }
    ?>
</body>
</html>