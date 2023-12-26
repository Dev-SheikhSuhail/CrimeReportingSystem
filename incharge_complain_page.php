<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="user-styles.css">
    <link rel="stylesheet" href="reg-styles.css">
    <?php
    session_start();
    if (!isset($_SESSION['x']))
        header("location:inchargelogin.php");

    $conn = mysqli_connect("localhost", "root", "", "crime_portal");
    if (!$conn) {
        die("could not connect" . mysqli_error($conn));
    }

    $i_id = $_SESSION['email'];
    $result1 = mysqli_query($conn, "SELECT location FROM police_station where i_id='$i_id'");
    $q2 = mysqli_fetch_assoc($result1);
    $location = $q2['location'];

    if (isset($_POST['s2'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cid = $_POST['cid'];

            $_SESSION['cid'] = $cid;
            $qu = mysqli_query($conn, "select inc_status,location from complaint where c_id='$cid'");

            $q = mysqli_fetch_assoc($qu);

            $inc_st = $q['inc_status'];
            $loc = $q['location'];

            if (strcmp("$loc", "$location") != 0) {
                $msg = "Case not of your Location";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else if (strcmp("$inc_st", "Unassigned") == 0) {
                header("location:Incharge_complain_details.php");

            } else {
                header("location:incharge_complain_details1.php");
            }
        }
    }
    $query = "select c_id,type_crime,d_o_c,location,inc_status,p_id from complaint where location='$location' order by c_id desc";
    $result = mysqli_query($conn, $query);
    ?>
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

<body style="background-color: #dfdfdf">
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Home</a></button>
        </div>
        <nav id="nbr">
            <button id="btn"><a href="incharge_view_police.php">Police Officers</a></button>
            <button id="btn"><a href="inc_logout.php">Logout</a></button>
        </nav>
    </header>
    <form style="margin-top: 7%; margin-left: 40%;" method="post">
        <input type="text" name="cid"
            style="width: 250px; height: 40px; background: #141212; color: white; border:2px solid white;border-radius: 8px;"
            placeholder="&nbsp Complaint ID" id="ciid" onfocusout="f1()" required>
        <div>
            <input class="btn btn-primary" type="submit" value="Search" name="s2"
                style="margin-top: 10px; margin-left: 11%;">
        </div>
    </form>

    <div style="padding:50px;">
        <table class="table table-bordered">
            <thead class="thead-dark" style="background-color: black; color: white;">
                <tr>
                    <th scope="col">Complaint ID</th>
                    <th scope="col">Type of Crime</th>
                    <th scope="col">Date of Crime</th>
                    <th scope="col">Location</th>
                    <th scope="col">Complaint Status</th>
                    <th scope="col">Police ID</th>
                </tr>
            </thead>

            <?php
            while ($rows = mysqli_fetch_assoc($result)) {
                ?>
            <tbody style="background-color: #543030; color: black;">
                <tr>
                    <td>
                        <?php echo $rows['c_id']; ?>
                    </td>
                    <td>
                        <?php echo $rows['type_crime']; ?>
                    </td>
                    <td>
                        <?php echo $rows['d_o_c']; ?>
                    </td>
                    <td>
                        <?php echo $rows['location']; ?>
                    </td>
                    <td>
                        <?php echo $rows['inc_status']; ?>
                    </td>
                    <td>
                        <?php echo $rows['p_id']; ?>
                    </td>
                </tr>
            </tbody>
            <?php
            }
            ?>

        </table>
    </div>
    <div id="footer">
        <div id="ftr-txt">&copy;Crime Portal - 2023 (Kashmir)</div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>