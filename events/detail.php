<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Event Backend</title>

    <base href="../">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="assets/css/custom.css" rel="stylesheet">
</head>
<?php
    include "../fuzhi.php";
    include "../chelogin.php";
    if(!empty($_GET["id"])){  
        $istr = $_GET["id"];
        $_SESSION["ev_id"] = $istr;
    }else{
        $istr = $_SESSION["ev_id"];
    }
    $sql = "select * from events where id='$istr'";
    $result = $con->query($sql);
    $arr = $result->fetch_array();
?>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="events/index.html">Event Platform</a>
    <span class="navbar-organizer w-100"><?=$_SESSION["name"]?></span>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" id="logout" href="out.php">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="events/index.html">Manage Events</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>{insert event name}</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="events/detail.html">Overview</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Reports</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item"><a class="nav-link" href="reports/index.html">Room capacity</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2 event-title">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2"><?=$arr["name"];$_SESSION["ev_name"]=$arr["name"]?></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="events/edit.php?id=<?=$istr?>" class="btn btn-sm btn-outline-secondary">Edit event</a>
                        </div>
                    </div>
                </div>
                <span class="h6"><?=$arr["name"];$_SESSION["ev_date"]=$arr["date"]?></span>
            </div>

            <!-- Tickets -->
            <div id="tickets" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Tickets</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="tickets/create.php?id=<?=$istr?>" class="btn btn-sm btn-outline-secondary">
                                Create new ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row tickets">
<?php
    $sql = "select * from event_tickets where event_id='$istr'";
    $result = $con->query($sql);
    while($arr=$result->fetch_array()){
?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?=$arr["name"]?></h5>
                            <p class="card-text"><?=$arr["cost"]?>
                            <p class="card-text">
                                <?php
                                   if(isset($arr["special_validity"])){
                                        $spe = json_decode($arr["special_validity"],true);
                                        if($spe["type"]=="date"){
                                            echo "Available until ".$spe["date"];
                                        }
                                        if($spe["type"]=="amount"){
                                            echo $spe["amount"]." tickets available";
                                        }
                                   }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
<?php
    }

?>
            </div>

            <!-- Sessions -->
            <div id="sessions" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Sessions</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="sessions/create.php?id=<?=$istr?>" class="btn btn-sm btn-outline-secondary">
                                Create new session
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive sessions">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th>Type</th>
                        <th class="w-100">Title</th>
                        <th>Speaker</th>
                        <th>Channel</th>
                    </tr>
                    </thead>
                    <tbody>
<?php
    $sql = "select *,sessions.id as se_id,channels.name as cha_name from events,channels,rooms,sessions 
    where events.id=channels.event_id and channels.id=rooms.channel_id and rooms.id=sessions.room_id and events.id='$istr'";
    $result = $con->query($sql);
    while($arr = $result->fetch_array()){
?>
                    <tr>
                        <td class="text-nowrap">
                            <?php
                                $start = strtotime($arr["start"]);
                                $start = date("H:i:s",$start);
                                $end = strtotime($arr["end"]);
                                $end = date("H:i:s",$end);
                                echo $start ."-".$end;
                            ?>
                        </td>
                        <td><?=$arr["type"]?></td>
                        <td><a href="sessions/edit.php?id=<?=$arr["se_id"]?>"><?=$arr["title"]?></a></td>
                        <td class="text-nowrap"><?=$arr["speaker"]?></td>
                        <td class="text-nowrap"><?=$arr["cha_name"]?></td>
                    </tr>
<?php
    }
?>
                    </tbody>
                </table>
            </div>

            <!-- Channels -->
            <div id="channels" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Channels</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="channels/create.php?id=<?=$istr?>" class="btn btn-sm btn-outline-secondary">
                                Create new channel
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row channels">
<?php
    $sql = "select * from channels where event_id='$istr'";
    $result = $con->query($sql);
    while($arr = $result->fetch_array()){
        $channel_id = $arr["id"];
        $sql2 = "select count(distinct room_id) as roo_id,count(distinct sessions.id) as se_id from 
        channels,rooms,sessions where channels.id=rooms.channel_id and rooms.id=sessions.room_id and channels.id='$channel_id'";
        $result2 = $con->query($sql2);
        $arr2 = $result2->fetch_array();
?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?=$arr["name"]?></h5>
                            <p class="card-text"><?=$arr2["se_id"]." sessions ,".$arr2["roo_id"]." room"?></p>
                        </div>
                    </div>
                </div>
<?php
    }
?>
            </div>

            <!-- Rooms -->
            <div id="rooms" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Rooms</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="rooms/create.php?id=<?=$istr?>" class="btn btn-sm btn-outline-secondary">
                                Create new room
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive rooms">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Capacity</th>
                    </tr>
                    </thead>
                    <tbody>
    <?php
        $sql = "select rooms.name,rooms.capacity from channels,rooms
        where channels.id=rooms.channel_id and channels.id='$istr'";
        $result = $con->query($sql);
        while($arr = $result->fetch_array()){
    ?>
                    <tr>
                        <td><?=$arr["name"]?></td>
                        <td><?=$arr["capacity"]?></td>
                    </tr>
    <?php
        }
    ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

</body>
</html>
