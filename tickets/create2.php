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
    $cost = $_POST["cost"];
    $special_validity = $_POST["special_validity"];
    $amount = $_POST["amount"];
    $valid_until = $_POST["valid_until"];

    str_kong($name,"name");
    str_kong($cost,"cost");
    str_kong($special_validity,"special_validity");
    if($special_validity=="date"){
        str_kong($valid_until,"date");
        $special_validity = array("type"=>"date","date"=>$valid_until);
    }
    if($special_validity=="amount"){
        str_kong($amount,"amount");
        $special_validity = array("type"=>"amount","amount"=>$amount);
    }
    $special_validity = json_encode($special_validity);
    $sql = "insert into event_tickets (event_id,name,cost,special_validity) value ('$istr','$name','$cost','$special_validity')";
    $con->query($sql);
?>
<script>alert("Ticket successfully created");window.location.href='../events/detail.php?id=<?=$istr?>'</script>
</body>
</html>