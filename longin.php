<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "fuzhi.php";
        session_start();
        $email = $_POST["email"];
        $password = $_POST["password"];
        $sql = "select *,count(*) as cou from organizers where email='$email' and password_hash='$password'";
        $result = $con->query($sql);
        $arr = $result->fetch_array();
        if(empty($arr["cou"])){
            echo "<script>alert('Email or password not correct');window.history.back()</script>";
            die();
        }else{
            $_SESSION["name"] = $arr["name"];
            echo "<script>window.location.href='events/index.php?id=".$arr["id"]."'</script>";
        }

    ?>
</body>
</html>