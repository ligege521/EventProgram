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
    $slug = $_POST["slug"];
    $date = $_POST["date"];

    str_kong($name,"name");
    str_kong($slug,"slug");
    str_kong($date,"date");

    if(preg_match("/[^a-z0-9 ]/i",$name)){  ?>
        <script>alert("Slug must not be empty and only contain a-z, 0-9 and ‘-'");window.history.back();</script><?php
        die();
    }

    $sql = "select count(*) as cou from events where slug='$slug'";
    $result = $con->query($sql);
    $arr = $result->fetch_array();

    
        $sql = "update events set name='$name',slug='$slug',date='$date'";
        $con->query($sql);
        
    
?>
<script>alert('Event successfully updated');window.location.href='index.php?id=<?=$istr?>'</script>;
</body>
</html>