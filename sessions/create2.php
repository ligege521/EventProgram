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

        $sql = "select count(*) as cou from sessions where ((start<='$start' and end>='$start') or (start<='$end' and end>='$end')) and room_id='$room'";
        $result = $con->query($sql);
        $arr = $result->fetch_array();
        if(!empty($arr["cou"])){    ?>
            <script>alert("Room already booked during this time");window.location.href='../events/detail.php?id=<?=$istr?>'</script><?php
            die();
        }
        $sql = "insert into sessions (room_id,title,description,speaker,start,end,type,cost) values 
        ('$room','$title','$description','$speaker','$start','$end','$type','$cost')";
        $con->query($sql);
       
    ?>
    <script>
        alert("Session successfully updated");window.location.href='../events/detail.php?id=<?=$istr?>';
    </script>
</body>
</html>