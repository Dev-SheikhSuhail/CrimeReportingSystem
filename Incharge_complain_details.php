<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    session_start();
    if (!isset($_SESSION['x']))
        header("location:inchargelogin.php");

    $conn = mysqli_connect("localhost", "root", "", "crime_portal");
    if (!$conn) {
        die("could not connect" . mysqli_error($conn));
    }
    $cid = $_SESSION['cid'];
    $i_id = $_SESSION['email'];
    // print_r($i_id);
    $result1 = mysqli_query($conn, "SELECT location FROM police_station where i_id='$i_id'");

    $q2 = mysqli_fetch_assoc($result1);
    $location = $q2['location'];

    $query = "select c_id,type_crime,d_o_c,description from complaint where c_id='$cid' and location='$location'";
    $result = mysqli_query($conn, $query);
    if (isset($_POST['assign'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pname = $_POST['police_name'];
            $res1 = mysqli_query($conn, "SELECT p_id FROM police where p_name='$pname'");
            $q3 = mysqli_fetch_assoc($res1);
            $pid = $q3['p_id'];
            $res = mysqli_query($conn, "UPDATE complaint set inc_status='Assigned',pol_status='In Process',p_id='$pid' where c_id='$cid'");
            $message = "Case Assigned Successfully";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
    ?>
    <title>Assign Officer</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="user-styles.css">
    <link rel="stylesheet" href="reg-styles.css">
</head>

<body>
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Home</a></button>
        </div>
        <nav id="nbr">
            <button id="btn"><a href="Incharge_complain_page.php">View Cases</a></button>
            <button id="btn"><a href="inc_logout.php">Logout</a></button>
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
                    </tr>
                </tbody>
                <?php
            }
            ?>
        </table>
    </div>
    <div>
        <form method="post">
            <select class="form-control" name="police_name"
                style="margin-left:40%; width:250px; background: #141212; color: white;height: 40px;border:2px solid white;border-radius: 8px;">
                <?php
                $p_name = mysqli_query($conn, "select p_name from police where location='$location'");
                while ($row = mysqli_fetch_array($p_name)) {
                    ?>
                    <option>
                        <?php echo $row[0]; ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <input type="submit" name="assign" value="Assign Case" class="btn btn-primary" id="bttn"
                style="margin-top:10px; margin-left:45%;">
        </form>
    </div>

    <div id="footer">
        <div id="ftr-txt">&copy;Crime Portal - 2023 (Kashmir)</div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>