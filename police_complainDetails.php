<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Details</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="user-styles.css">
    <link rel="stylesheet" href="reg-styles.css">
    <?php
    session_start();
    if (!isset($_SESSION['x']))
        header("location:policelogin.php");
    $conn = mysqli_connect("localhost", "root", "", "crime_portal");
    if (!$conn) {
        die("could not connect" . mysqli_error($conn));
    }
    mysqli_select_db($conn, "crime_portal");

    $cid = $_SESSION['cid'];
    $p_id = $_SESSION['pol'];

    $query = "select c_id,type_crime,d_o_c,description,mob,u_addr from complaint natural join user where c_id='$cid' and p_id='$p_id'";
    $result = mysqli_query($conn, $query);

    if (isset($_POST['status'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $upd = $_POST['update'];
            $qu1 = mysqli_query($conn, "insert into update_case(c_id,case_update) values('$cid','$upd')");
        }
    }

    if (isset($_POST['close'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $up = $_POST['final_report'];
            $qu2 = mysqli_query($conn, "insert into update_case(c_id,case_update) values('$cid','$up')");
            $q2 = mysqli_query($conn, "update complaint set pol_status='ChargeSheet Filed' where c_id='$cid'");
        }
    }
    $res2 = mysqli_query($conn, "select d_o_u,case_update from update_case where c_id='$cid'");
    ?>

    <script>
        function f1() {
            var sta2 = document.getElementById("ciid").value;
            var x2 = sta2.indexOf(' ');
            if (sta2 == "" && x2 >= 0) {
                document.getElementById("ciid").value = "";
                alert("Blank Field Not Allowed");
            }
        }
    </script>
</head>

<body style="background: linear-gradient(to bottom right, #1111a7, #c1a7ac);">
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Home</a></button>
        </div>
        <nav id="nbr">
            <button id="btn"><a href="police_pending_complain.php">Pending Cases</a></button>
            <button id="btn"><a href="p_logout.php">Logout</a></button>
        </nav>
    </header>

    <div style="padding:50px; margin-top:10px;">
        <table class="table table-bordered">
            <thead class="thead-dark" style="background-color: black; color: white;">
                <tr>
                    <th scope="col">Complaint ID</th>
                    <th scope="col">Type of Crime</th>
                    <th scope="col">Date of Crime</th>
                    <th scope="col">Description</th>
                    <th scope="col">Complainant Mobile</th>
                    <th scope="col">Complainant Address</th>
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
                            <?php echo $rows['description']; ?>
                        </td>
                        <td>
                            <?php echo $rows['mob']; ?>
                        </td>
                        <td>
                            <?php echo $rows['u_addr']; ?>
                        </td>
                    </tr>
                </tbody>
                <?php
            }
            ?>
        </table>
    </div>

    <div style="padding:50px; margin-top:8px;">
        <table class="table table-bordered">
            <thead class="thead-dark" style="background-color: black; color: white;">
                <tr>
                    <th scope="col">Date Of Update</th>
                    <th scope="col">Case Update</th>
                </tr>
            </thead>
            <?php
            while ($rows1 = mysqli_fetch_assoc($res2)) {
                ?>
                <tbody style="background-color: #543030; color: black;">
                    <tr>
                        <td>
                            <?php echo $rows1['d_o_u']; ?>
                        </td>
                        <td>
                            <?php echo $rows1['case_update']; ?>
                        </td>
                    </tr>
                </tbody>
                <?php
            }
            ?>
        </table>
    </div>

    <div style="width: 100%; height: 250px;">
        <div style="width: 50%;float: left;height: 250px;">
            <form method="post">
                <h5 style="text-align: center;"><b>Complaint ID</b></h5>
                <input type="text" name="cid" style="margin-left: 47%; width: 50px; background: Black;" disabled
                    value="<?php echo "$cid" ?>">
                <select class="form-control"
                    style="align-content: center;margin-top: 20px; margin-left: 35%; width: 180px; background: #141212; color: white;height: 40px;border:2px solid white;border-radius: 8px;"
                    name="update">
                    <option>Criminal Verified</option>
                    <option>Criminal Caught</option>
                    <option>Criminal Interrogated</option>
                    <option>Criminal Accepted the Crime</option>
                    <option>Criminal Charged</option>
                </select>
                <input class="btn btn-primary btn-sm" type="submit" value="Update Case Status" name="status"
                    style="margin-top: 10px; margin-left: 40%;">
            </form>
        </div>
        <div style="width: 50%;float: right;height: 250px;">
            <form method="post">
                <textarea name="final_report" cols="40" rows="5" placeholder="Final Report"
                    style="margin-top: 20px;margin-left: 20px; color:black; border: 2px black solid; border-radius:4px;"
                    id="ciid" onfocusout="f1()" required></textarea>
                <div>
                    <input class="btn btn-danger" type="submit" value="Close Case" name="close"
                        style="margin-left: 20px; margin-top: 10px; margin-bottom:20px;">
                </div>
            </form>
        </div>
        <div id="footer">
            <div id="ftr-txt">&copy;Crime Portal - 2023 (Kashmir)</div>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
        </script>
</body>

</html>