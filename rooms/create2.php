<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
         include "../fuzhi.php";
         include "../chelogin.php";
         $istr = $_GET["id"];
         $name = $_POST["name"];
         $channel =$_POST["channel"];
         $capacity =$_POST["capacity"];
         str_kong($name,"name");
         str_kong($channel,"channel");
         str_kong($capacity,"capacity");
         $sql = "insert into rooms (channel_id,name,capacity) values ('$channel','$name','$capacity')";
         $con->query($sql);
         
?>
<script>
        alert("rooms successfully updated");window.location.href='../events/detail.php?id=<?=$istr?>';
    </script>
</body>
</html>