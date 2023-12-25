<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="user-styles.css">
    <link rel="stylesheet" href="reg-styles.css">
    <?php
    if (isset($_POST['s'])) {
        session_start();
        $_SESSION['x'] = 1;
        $conn = mysqli_connect("localhost", "root", "", "crime_portal");
        if (!$conn) {
            die("could not connect" . mysqli_error($conn));
        }
        mysqli_select_db($conn, "crime_portal");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['email'];
            $pass = $_POST['password'];
            $u_id = $_POST['email'];
            $_SESSION['u_id'] = $u_id;
            $result = mysqli_query($conn, "SELECT u_id,u_pass FROM user where u_id='$name' and u_pass='$pass' ");

            if (!$result || mysqli_num_rows($result) == 0) {
                $message = "ID or Password Not Matched.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                header("location:complainer_page.php");

            }
        }
    }
    ?>
    <script>
    function f1() {
        var sta2 = document.getElementById("exampleInputEmail1").value;
        var sta3 = document.getElementById("exampleInputPassword1").value;
        var x2 = sta2.indexOf(' ');
        var x3 = sta3.indexOf(' ');
        if (sta2 != "" && x2 >= 0) {
            document.getElementById("exampleInputEmail1").value = "";
            document.getElementById("exampleInputEmail1").focus();
            alert("Space Not Allowed");
        } else if (sta3 != "" && x3 >= 0) {
            document.getElementById("exampleInputPassword1").value = "";
            document.getElementById("exampleInputPassword1").focus();
            alert("Space Not Allowed");
        }

    }
    </script>
</head>

<body>
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Crime Portal</a></button>
        </div>
        <div style="font-size:24px;">User Login</div>
        <!-- <nav id="nbr">
            <button id="btn"><a href="userlogin.php">User Login</a></button>
        </nav> -->
    </header>

    <div align="center">
        <div class="form" style="margin-top: 10%">
            <form method="post">
                <div class="form-group" style="width: 30%">
                    <label for="exampleInputEmail1">
                        <h1 style="color: #fff;">User ID</h1>
                    </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        size="5" placeholder="Enter Email-ID" required name="email" onfocusout="f1()">
                </div>
                <div class="form-group" style="width:30%">
                    <label for="exampleInputPassword1">
                        <h1 style="color: #fff;">Password</h1>
                    </label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                        required name="password" onfocusout="f1()">
                </div>

                <button type="submit" class="btn btn-primary" id="bttn" name="s" onclick="f1()">Login</button>
            </form>
        </div>
    </div>
    <div id="footer">
        <div id="ftr-txt">&copy;Crime Portal - 2023 (Kashmir)</div>
    </div>
</body>

</html>