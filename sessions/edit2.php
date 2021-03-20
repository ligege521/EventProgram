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
        $type = $_POST["type"];
        $title = $_POST["title"];
        $speaker = $_POST["speaker"];
        $room = $_POST["room"];
        $cost = $_POST["cost"];
        $start = $_POST["start"];
        $end = $_POST["end"];
        $description = $_POST["description"];

        str_kong($type,"type");
        str_kong($title,"title");
        str_kong($speaker,"speaker");
        str_kong($room,"room");
        str_kong($start,"start");
        str_kong($end,"end");
        str_kong($description,"description");

        $sql = "update sessions set type='$type',room_id='$room',title='$title',speaker='$speaker',cost='$cost',start='$start',end='$end',description='$description' where id='$istr'";
        $con->query($sql);
       
    ?>
   <script>alert("Session successfully updated");window.location.href="../events/detail.php"</script>
</body>
</html>