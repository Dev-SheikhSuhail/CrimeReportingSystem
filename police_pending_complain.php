<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Complaints</title>
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
    if (isset($_POST['s2'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cid = $_POST['cid'];
            $_SESSION['cid'] = $cid;
            $alok = mysqli_query($conn, "SELECT p_id FROM complaint WHERE c_id='$cid'");
            $row = mysqli_fetch_assoc($alok);
            $p_id = $_SESSION['pol'];
            if ($row['p_id'] == $p_id) {
                header("location:police_complainDetails.php");
            } else {
                $message = "Not in your scope";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    }
    $p_id = $_SESSION['pol'];
    $result = mysqli_query($conn, "SELECT c_id,type_crime,d_o_c,location FROM complaint where p_id='$p_id' and pol_status='In Process' order by c_id desc");
    ?>
    <script>
    function f1() {
        var sta2 = document.getElementById("ciid").value;
        var x2 = sta2.indexOf(' ');
        if (sta2 != "" && x2 >= 0) {
            document.getElementById("ciid").value = "";
            alert("Blank Field Found");
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
            <button id="btn"><a href="police_complete.php">Completed Cases</a></button>
            <button id="btn"><a href="p_logout.php">Logout</a></button>
        </nav>
    </header>
    <div style="text-align:center; font-size:30px; color:black; margin-top: 2%; font-weight:700 ;">Pending Complaints
    </div>

    <form style="margin-top: 7%; margin-left: 40%;" method="post">
        <input type="text" name="cid"
            style="width: 250px; height: 40px; background: #141212; color: white; border:2px solid white;border-radius: 8px; margin-top:5px;"
            placeholder="&nbsp Complaint ID" onfocusout="f1()" required id="ciid">
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
                    <th scope="col">Location of Crime</th>

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