<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['x']))
    header("location:userlogin.php");


$conn = mysqli_connect("localhost", "root", "", "crime_portal");
if (!$conn) {
    die("could not connect" . mysqli_error($conn));
}
mysqli_select_db($conn, "crime_portal");

$u_id = $_SESSION['u_id'];

$result = mysqli_query($conn, "SELECT a_no FROM user where u_id='$u_id' ");
$q2 = mysqli_fetch_assoc($result);
$a_no = $q2['a_no'];

$result1 = mysqli_query($conn, "SELECT u_name FROM user where u_id='$u_id' ");
$q2 = mysqli_fetch_assoc($result1);
$u_name = $q2['u_name'];


if (isset($_POST['s'])) {
    $con = mysqli_connect('localhost', 'root', '');
    if (!$con) {
        die('could not connect: ' . mysqli_error($conn));
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $location = $_POST['location'];
        $type_crime = $_POST['type_crime'];
        $d_o_c = $_POST['d_o_c'];
        $description = $_POST['description'];

        $var = strtotime(date("Ymd")) - strtotime($d_o_c);


        if ($var >= 0) {

            $comp = "INSERT into complaint(a_no,location,type_crime,d_o_c,description) values('$a_no','$location','$type_crime','$d_o_c','$description')";
            mysqli_select_db($conn, "crime_portal");
            $res = mysqli_query($conn, $comp);

            if (!$res) {
                $message1 = "Complaint already filed";
                echo "<script type='text/javascript'>alert('$message1');</script>";
            } else {
                $message = "Complaint Registered Successfully";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        } else {
            $message = "Enter Valid Date";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>

<script>
function f1() {
    var sta1 = document.getElementById("desc").value;
    var x1 = sta1.trim();
    if (sta1 != "" && x1 == "") {
        document.getElementById("desc").value = "";
        document.getElementById("desc").focus();
        alert("Space Found");
    }
}
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="complainer_page.css">
    <link rel="stylesheet" href="user-styles.css">
    <link rel="stylesheet" href="reg-styles.css">
</head>

<body>
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Crime Portal</a></button>
        </div>
        <nav id="nbr">
            <button id="btn"><a href="complainer_complain_history.php">Complaint History</a></button>
            <button id="btn"><a href="logout.php">Logout</a></button>
        </nav>
    </header>

    <div class="video" style="margin-top: 2px">
        <div class="center-container">
            <div class="bg-agile">
                <div class="login-form">
                    <p>
                    <h2 style="color:white">Welcome
                        <?php echo "$u_name" ?>
                    </h2>
                    </p>
                    <p>
                    <h2>New Complaint</h2>
                    </p>
                    <form action="#" method="post" style="color: gray">Aadhar
                        <input type="text" name="aadhar_number" placeholder="Aadhar Number" required="" disabled
                            value=<?php echo "$a_no"; ?>>

                        <div class="top-w3-agile" style="color: gray">Location of Crime

                            <select class="form-control" name="location">
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
                        </div>
                        <div class="top-w3-agile" style="color: gray">Type of Crime
                            <select class="form-control" name="type_crime">
                                <option>Theft</option>
                                <option>Robbery</option>
                                <option>Pick Pocket</option>
                                <option>Murder</option>
                                <option>Rape</option>
                                <option>Molestation</option>
                                <option>Kidnapping</option>
                                <option>Missing Person</option>
                            </select>
                        </div>
                        <div class="Top-w3-agile" style="color: gray">
                            Date Of Crime : &nbsp &nbsp
                            <input style="background-color: #313131;color: white" type="date" name="d_o_c" required>
                        </div>
                        <br>
                        <div class="top-w3-agile" style="color: gray">
                            Description
                            <textarea name="description" rows="20" cols="50"
                                placeholder="Describe the incident in details with time" onfocusout="f1()" id="desc"
                                required></textarea>
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