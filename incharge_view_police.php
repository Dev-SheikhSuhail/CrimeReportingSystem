<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Officers</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="user-styles.css">
    <?php
    session_start();
    if (!isset($_SESSION['x']))
        header("location:inchargelogin.php");

    $conn = mysqli_connect("localhost", "root", "", "crime_portal");
    if (!$conn) {
        die("could not connect" . mysqli_error($conn));
    }

    $i_id = $_SESSION['email'];
    print_r($i_id);
    $result1 = mysqli_query($conn, "SELECT location FROM police_station where i_id='$i_id'");

    $q2 = mysqli_fetch_assoc($result1);

    $location = $q2['location'];

    if (isset($_POST['s2'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pid = $_POST['pid'];

            $q1 = mysqli_query($conn, "delete from police where p_id='$pid'");
            $q3 = mysqli_query($conn, "update complaint set pol_status='null',inc_status='Unassigned',p_id='Null' where p_id='$pid'");
        }
    }

    $result = mysqli_query($conn, "select p_id,p_name,spec,location from police where location='$location'");
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
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"><b>Crime Portal</b></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">

                <ul class="nav navbar-nav">
                    <li><a href="official_login.php">Official Login</a></li>
                    <li><a href="inchargelogin.php">Incharge Login</a></li>
                    <li class="active"><a href="incharge_view_police.php">Incharge Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="Incharge_complain_page.php">View Complaints</a></li>
                    <li class="active"><a href="incharge_view_police.php">Police Officers</a></li>
                    <li><a href="inc_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="margin-top: 10%;margin-left: 45%">
        <a href="police_add.php"><input type="button" name="add" value="Add Police Officer" class="btn btn-primary"></a>
    </div>

    <div style="padding:50px;">
        <table class="table table-bordered">
            <thead class="thead-dark" style="background-color: black; color: white;">
                <tr>
                    <th scope="col">Police ID</th>
                    <th scope="col">Police Name</th>
                    <th scope="col">Specialist</th>
                    <th scope="col">Location</th>
                </tr>
            </thead>

            <?php
            while ($rows = mysqli_fetch_assoc($result)) {
                ?>

                <tbody style="background-color: white; color: black;">
                    <tr>
                        <td>
                            <?php echo $rows['p_id']; ?>
                        </td>
                        <td>
                            <?php echo $rows['p_name']; ?>
                        </td>
                        <td>
                            <?php echo $rows['spec']; ?>
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

    <form style="margin-top: 5%; margin-left: 40%;" method="post">
        <input type="text" name="pid" style="width: 250px; height: 30px; background-color:white;"
            placeholder="&nbsp Police ID" id="ciid" onfocusout="f1()" required>
        <div>
            <input class="btn btn-danger" type="submit" value="Delete Police" name="s2"
                style="margin-top: 10px; margin-left: 9%;">
        </div>
    </form>
    <div id="footer">
        <div id="ftr-txt">&copy;Crime Portal - 2023 (Kashmir)</div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>