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
    mysqli_select_db($conn, "crime_portal", );
    if (isset($_POST['s1'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cid = $_POST['cid'];
            $_SESSION['cid'] = $cid;
            header("location:head_case_details.php");
        }
    }

    $loc = $_SESSION['loc'];
    $query = "select c_id,type_crime,d_o_c,location from complaint where location='$loc' order by c_id desc";
    $result = mysqli_query($conn, $query);
    ?>
    <title>Head Home1</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="user-styles.css">
    <link rel="stylesheet" href="reg-styles.css">
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

<body style="background-image: url(images/search1.jpeg);">
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Home</a></button>
        </div>
        <nav id="nbr">
            <button id="btn"><a href="headHome.php">Search Complaint</a></button>
            <button id="btn"><a href="h_logout.php">Logout</a></button>
        </nav>
    </header>


    <div style="padding:50px;">
        <table class="table table-bordered">
            <thead class="thead-dark" style="background-color: black; color:white;">
                <tr>
                    <th scope="col">Complain ID</th>
                    <th scope="col">Type of Crime</th>
                    <th scope="col">Date Of Crime</th>
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