<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Police Officer</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="complainer_page.css">
    <link rel="stylesheet" href="user-styles.css">
    <link rel="stylesheet" href="reg-styles.css">
    <?php
    session_start();
    if (!isset($_SESSION['x']))
        header("location:inchargelogin.php");

    $con = mysqli_connect('localhost', 'root', '', 'crime_portal');
    if (!$con) {
        die('could not connect: ' . mysqli_error($con));
    }
    mysqli_select_db($con, "crime_portal");

    $i_id = $_SESSION['email'];

    $result1 = mysqli_query($con, "SELECT location FROM police_station where i_id='$i_id'");

    $q2 = mysqli_fetch_assoc($result1);
    $location = $q2['location'];

    if (isset($_POST['s'])) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $p_name = $_POST['police_name'];
            $p_id = $_POST['police_id'];
            $spec = $_POST['police_spec'];
            $p_pass = $_POST['password'];

            $reg = "insert into police values('$p_name','$p_id','$spec','$location','$p_pass')";

            $res = mysqli_query($con, $reg);
            if (!$res) {
                $message = "User already Exists.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $message = "Police Added Successfully";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    }
    ?>
    <script>
        function f1() {
            var sta = document.getElementById("pname").value;
            var sta1 = document.getElementById("pid").value;
            var sta2 = document.getElementById("pspec").value;
            var sta3 = document.getElementById("pas").value;
            var x = sta.trim();
            var x1 = sta1.indexOf(' ');
            var x2 = sta2.trim();
            var x3 = sta3.indexOf(' ');
            if (sta != "" && x == "") {
                document.getElementById("pname").value = "";
                document.getElementById("pname1p").focus();
                alert("Space Not Allowed");
            } else if (sta1 != "" && x1 >= 0) {
                document.getElementById("pid").value = "";
                document.getElementById("pid").focus();
                alert("Space Not Allowed");
            } else if (sta2 != "" && x2 == "") {
                document.getElementById("pspec").value = "";
                document.getElementById("pspec").focus();
                alert("Space Not Allowed");
            } else if (sta3 != "" && x3 >= 0) {
                document.getElementById("pas").value = "";
                document.getElementById("pas").focus();
                alert("Space Not Allowed");
            }
        }
    </script>
</head>

<body style="background-size: cover;
    background-image: url(images/regi_bg.jpeg);
    background-position: center;">
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Home</a></button>
        </div>
        <nav id="nbr">
            <button id="btn"><a href="incharge_view_police.php">View Officers</a></button>
            <button id="btn"><a href="Incharge_complain_page.php">Complaints</a></button>
            <button id="btn"><a href="h_logout.php">Logout</a></button>
        </nav>
    </header>
    <div class="video" style="margin-top: 2%">
        <div class="center-container">
            <div class="bg-agile">
                <div class="login-form">
                    <p>
                    <h2>Add Police Officer</h2>
                    </p><br>
                    <form action="#" method="post" style="color: gray">Police Name
                        <input type="text" name="police_name" placeholder="Officer Name" required="" id="pname"
                            onfocusout="f1()" />
                        Police ID<input type="text" name="police_id" placeholder="Set Police ID" required="" id="pid"
                            onfocusout="f1()" />
                        Specialist<input type="text" name="police_spec" id="pspec" required onfocusout="f1()" />

                        Location of Police Officer<input type="text" required name="location" disabled
                            value="<?php echo "$location"; ?>">
                        <br>
                        Password<input type="text" name="password" placeholder="Password" id="pas" onfocusout="f1()"
                            required />
                        <input type="submit" value="Submit" name="s">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div id="ftr-txt">&copy;Crime Portal - 2023 (Kashmir)</div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>