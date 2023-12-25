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
    <link rel="stylesheet" href="reg-styles.css">

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
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Home</a></button>
        </div>
        <nav id="nbr">
            <button id="btn"><a href="head_view_police_station.php">Police Stations</a></button>
            <button id="btn"><a href="h_logout.php">Logout</a></button>
        </nav>
    </header>

    <div>
        <form style="margin-top: 10%; margin-left: 40%;" method="post">
            <input type="text" name="cid"
                style="width: 250px; height: 40px; background: #141212; color: white; border:2px solid white;border-radius: 8px;"
                placeholder="&nbsp Complaint ID" id="ciid" onfocusout="f1()" required>
            <div>
                <input class="btn btn-primary" type="submit" value="Search" name="s1"
                    style="margin-top: 10px; margin-left: 11%;">
            </div>
        </form>

        <form style="margin-top: 3%; margin-left: 40%;" method="post">
            <select name="loc" class="form-control"
                style="width: 250px; background: #141212; color: white;height: 40px;border:2px solid white;border-radius: 8px;">

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