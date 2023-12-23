<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start();
    if (!isset($_SESSION['x']))
        header("location:headlogin.php");
    $conn = mysqli_connect("localhost", "root", "", "crime_portal");
    if (!$conn) {
        die("could not connect" . mysqli_error($conn));
    }
    mysqli_select_db($conn, "crime_portal");

    $query = "select i_id,i_name,location from police_station";
    $result = mysqli_query($conn, $query);
    ?>
    <title>View Police Stations</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="user-styles.css">
</head>

<body>
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

                    <li><a href="headlogin.php">Head Login</a></li>
                    <li class="active"><a href="head_view_police_station.php">Head Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="headHome.php">View Complaints</a></li>
                    <li class="active"><a href="head_view_police_station.php">Police Stations</a></li>
                    <li><a href="h_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div style="margin-top: 10%;margin-left: 45%">
        <a href="police_station_add.php" class="btn btn-primary">Add Police Station</a>
    </div>

    <div style="padding:50px;">
        <table class="table table-bordered">
            <thead class="thead-dark" style="background-color: black; color: white;">
                <tr>
                    <th scope="col">Incharge ID</th>
                    <th scope="col">Incharge Name</th>
                    <th scope="col">Location of Police Station</th>
                </tr>
            </thead>
            <?php
            while ($rows = mysqli_fetch_assoc($result)) {
                ?>

            <tbody style="background-color: white; color: black;">
                <tr>
                    <td>
                        <?php echo $rows['i_id']; ?>
                    </td>
                    <td>
                        <?php echo $rows['i_name']; ?>
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