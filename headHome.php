<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start();
    if (!isset($_SESSION['x']))
        header("location:headlogin.php");

    $conn = mysqli_connect("localhost", "root", "", "crime_portal");
    if (!$conn) {
        die("could not connect" . mysqli_error($conn));
    }
    mysqli_select_db($conn, "crime_portal");

    if (isset($_POST['s1'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cid = $_POST['cid'];
            $_SESSION['cid'] = $cid;
            header("location:head_case_details.php");
        }
    }

    if (isset($_POST['s2'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $loc = $_POST['loc'];
            $_SESSION['loc'] = $loc;
            header("location:headHome1.php");
        }
    }
    ?>

    <title>Head Home</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="user-styles.css">
    <script>
        function f1() {

            var sta2 = document.getElementById("ciid").value;
            var x2 = sta2.indexOf(' ');

            if (sta2 != "" && x2 >= 0) {
                document.getElementById("ciid").value = "";
                alert("Blank Field Not Allowed");
            }
        }
    </script>
</head>

<body style="background-image: url(images/search1.jpeg); ">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"><b>Crime Portal</b></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="official_login.php">Official Login</a></li>
                    <li><a href="headlogin.php">Head Login</a></li>
                    <li class="active"><a href="headHome.php">Head Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="headHome.php">View Complaints</a></li>
                    <li><a href="head_view_police_station.php">Police Stations</a></li>
                    <li><a href="h_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div>
        <form style="margin-top: 10%; margin-left: 40%;" method="post">
            <input type="text" name="cid" style="width: 250px; height: 30px;" placeholder="&nbsp Complaint ID" id="ciid"
                onfocusout="f1()" required>
            <div>
                <input class="btn btn-primary" type="submit" value="Search" name="s1"
                    style="margin-top: 10px; margin-left: 11%;">
            </div>
        </form>

        <form style="margin-top: 3%; margin-left: 40%;" method="post">
            <select name="loc" class="form-control" style="width: 250px;">

                <?php
                $loc = mysqli_query($conn, "select location from police_station");
                while ($row = mysqli_fetch_array($loc)) {
                    ?>
                    <option>
                        <?php echo $row[0]; ?>
                    </option>
                    <?php
                }
                ?>
            </select>

            <input class="btn btn-primary" type="submit" value="Search" name="s2"
                style="margin-top: 10px; margin-left: 11%;">
        </form>
    </div>
    <div id="footer">
        <div id="ftr-txt">&copy;Crime Portal - 2023 (Kashmir)</div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>