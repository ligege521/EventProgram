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
         str_kong($name,"name");
         $sql = "insert into channels (event_id,name) values ('$istr','$name')";
         $con->query($sql);
    ?>
    <script>
        alert("Channel successfully created");
        window.location.href='../events/detail.php?id=<?=$istr?>';
    </script>
</body>
</html>