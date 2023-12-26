<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Login</title>
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
            $result = mysqli_query($conn, "SELECT h_id,h_pass FROM head where h_id='$name' and h_pass='$pass' ");

            if (mysqli_num_rows($result) == 0) {
                $message = "ID or Password Not Matched.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                header("location:headHome.php");
            }
        }
    }
    ?>
</head>

<body style="background: linear-gradient(to bottom right, #1111a7, #c1a7ac);">
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Crime Portal</a></button>
        </div>
        <div style="font-size:24px;">Head Login</div>
    </header>

    <div align="center">
        <div class="form" style="margin-top: 15%">
            <form method="post">
                <div class="form-group" style="width: 30%">
                    <label for="exampleInputEmail1">
                        <h1 style="color:white">Head ID</h1>
                    </label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" size="5" placeholder="Enter ID" required>
                </div>
                <div class="form-group" style="width:30%">
                    <label for="exampleInputPassword1">
                        <h1 style="color:white">Password</h1>
                    </label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary" id="bttn" name="s">Login</button>
            </form>
        </div>
    </div>
    <div id="footer">
        <div id="ftr-txt">&copy;Crime Portal - 2023 (Kashmir)</div>
    </div>

</body>

</html>