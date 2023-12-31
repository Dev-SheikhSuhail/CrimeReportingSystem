<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_POST['s'])) {
    $con = mysqli_connect('localhost', 'root', '', 'crime_portal');
    if (!$con) {
        die('could not connect: ' . mysqli_error($con));
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $u_name = $_POST['name'];
        $u_id = $_POST['email'];
        $u_pass = $_POST['password'];
        $u_addr = $_POST['adress'];
        $a_no = $_POST['aadhar_number'];
        $gen = $_POST['gender'];
        $mob = $_POST['mobile_number'];
        // $password=md5($u_pass);
        $reg = "insert into user values('$u_name','$u_id','$u_pass','$u_addr','$a_no','$gen','$mob')";
        mysqli_select_db($con, "crime_portal");
        $res = mysqli_query($con, $reg);
        if (!$res) {
            $message1 = "User Already Exist";
            echo "<script type='text/javascript'>alert('$message1');</script>";
        } else {
            $message = "User Registered Successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>

<script>
function f1() {
    var sta = document.getElementById("name1").value;
    var sta1 = document.getElementById("email1").value;
    var sta2 = document.getElementById("pass").value;
    var sta3 = document.getElementById("addr").value;
    var sta4 = document.getElementById("aadh").value;
    var sta5 = document.getElementById("mobno").value;

    var x = sta.trim();
    var x1 = sta1.indexOf(' ');
    var x2 = sta2.indexOf(' ');
    var x3 = sta3.trim();
    var x4 = sta4.indexOf(' ');
    var x5 = sta5.indexOf(' ');
    if (sta != "" && x == "") {
        document.getElementById("name1").value = "";
        document.getElementById("name1").focus();
        alert("Space Not Allowed");
    } else if (sta1 != "" && x1 >= 0) {
        document.getElementById("email1").value = "";
        document.getElementById("email1").focus();
        alert("Space Not Allowed");
    } else if (sta2 != "" && x2 >= 0) {
        document.getElementById("pass").value = "";
        document.getElementById("pass").focus();
        alert("Space Not Allowed");
    } else if (sta3 != "" && x3 == "") {
        document.getElementById("addr").value = "";
        document.getElementById("addr").focus();
        alert("Space Not Allowed");
    } else if (sta4 != "" && x4 >= 0) {
        document.getElementById("aadh").value = "";
        document.getElementById("aadh").focus();
        alert("Space Not Allowed");
    } else if (sta5 != "" && x5 >= 0) {
        document.getElementById("mobno").value = "";
        document.getElementById("mobno").focus();
        alert("Space Not Allowed");
    }
}
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="complainer_page.css">
    <link rel="stylesheet" href="reg-styles.css">
</head>

<body>
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Crime Portal</a></button>
        </div>
        <nav id="nbr">
            <button id="btn"><a href="userlogin.php">Login</a></button>
        </nav>
    </header>

    <div class="video">
        <div class="center-container">
            <div class="bg-agile">
                <div class="login-form">
                    <p id="para">User Registration</p>
                    <form action="#" method="post">
                        <p>Full Name</p><input type="text" name="name" required="" id="name1" onfocusout="f1()" />
                        <p>Email-ID</p><input type="email" name="email" required="" id="email1" onfocusout="f1()" />
                        <p>Password</p><input type="password" name="password" placeholder="Minimum 6 Characters"
                            pattern=".{6,}" id="pass" onfocusout="f1()" />
                        <div class="left-w3-agile">
                            <div id="h-addr">
                                <p>Home Address</p><input type="text" name="adress" required="" id="addr"
                                    onfocusout="f1()" />
                            </div>
                            <div id="u-gen">
                                <p>Gender</p><select class="form-control" name="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="left-w3-agile">
                            <div id="aadhr">
                                <p>Aadhar Number</p><input type="text" name="aadhar_number" minlength="12"
                                    maxlength="12" required pattern="[123456789][0-9]{11}" id="aadh"
                                    onfocusout="f1()" />
                            </div>
                            <div id="mobl">
                                <p>Mobile</p><input type="text" name="mobile_number" required pattern="[6789][0-9]{9}"
                                    minlength="10" maxlength="10" id="mobno" onfocusout="f1()" />
                            </div>
                        </div>


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