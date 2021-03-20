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
    $istr = $_GET["id"];
    $sql = "select * from sessions where id='$istr'";
    $result = $con->query($sql);
    $arr = $result->fetch_array();
?>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="events/index.html">Event Platform</a>
    <span class="navbar-organizer w-100">{insert organization name}</span>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" id="logout" href="index.html">Sign out</a>
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
                    <li class="nav-item"><a class="nav-link" href="events/detail.html">Overview</a></li>
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
            <div class="border-bottom mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{insert event name}</h1>
                </div>
                <span class="h6">{insert event date}</span>
            </div>

            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Edit session</h2>
                </div>
            </div>

            <form class="needs-validation" novalidate action="sessions/edit2.php?id=<?=$istr?>" method="POST">

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="selectType">Type</label>
                        <select class="form-control" id="selectType" name="type">
                            <option value="talk" <?php if($arr["type"]=="talk") echo "selected";?> >Talk</option>
                            <option value="workshop" <?php if($arr["type"]=="workshop") echo "selected";?>>Workshop</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputTitle">Title</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control is-invalid" id="inputTitle" name="title" placeholder="" value="<?=$arr["title"]?>">
                        <div class="invalid-feedback">
                            Title is required.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputSpeaker">Speaker</label>
                        <input type="text" class="form-control" id="inputSpeaker" name="speaker" placeholder="" value="<?=$arr["speaker"]?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="selectRoom">Room</label>
                        <select class="form-control" id="selectRoom" name="room">
<?php
    $sql2 = "select * from rooms";
    $result2 = $con->query($sql2);
    while($arr2 = $result2->fetch_array()){
?>
                            <option value="<?=$arr2["id"]?>"><?=$arr2["name"]?></option>
<?php
    }
?>
                        </select>
                        <div class="invalid-feedback">
                            Room is required.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputCost">Cost</label>
                        <input type="number" class="form-control" id="inputCost" name="cost" placeholder="" value="<?=$arr["cost"]?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <label for="inputStart">Start</label>
                        <input type="text"
                               class="form-control"
                               id="inputStart"
                               name="start"
                               placeholder="yyyy-mm-dd HH:MM"
                               value="<?=$arr["start"]?>">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label for="inputEnd">End</label>
                        <input type="text"
                               class="form-control"
                               id="inputEnd"
                               name="end"
                               placeholder="yyyy-mm-dd HH:MM"
                               value="<?=$arr["end"]?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="textareaDescription">Description</label>
                        <textarea class="form-control" id="textareaDescription" name="description" placeholder="" rows="5"><?=$arr["description"]?></textarea>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Save session</button>
                <a href="events/detail.html" class="btn btn-link">Cancel</a>
            </form>

        </main>
    </div>
</div>

</body>
</html>
