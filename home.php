<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime Portal</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="logo-section">
            <a href="home.php"><img src="images/crs.png" /></a>
            <button id="btn-home"><a href="home.php">Home</a></button>
        </div>
        <nav id="nbr">
            <button id="btn"><a href="policelogin.php">Police Login</a></button>
            <button id="btn"><a href="inchargelogin.php">Incharge Login</a></button>
            <button id="btn"><a href="headlogin.php">Head Login</a></button>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="content">
                    <h1>Have a Complaint?</h1>
                    <hr>
                    <div class="login-buttons">
                        <div>
                            <h3>New User!</h3>
                            <a href="registration.php" class="btn btn-info btn-lg" style="background-color:#138496"
                                role="button" aria-pressed="true">Sign
                                Up</a>
                        </div>
                        <div>
                            <h3>Already Registered?</h3>
                            <a href="userlogin.php" class="btn btn-info btn-lg" style="background-color:#138496" role="
                                button" aria-pressed="true">
                                Login</a>
                        </div>
                    </div>
                    <hr>
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