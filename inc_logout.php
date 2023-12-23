<?php

session_start();

// Redirect the user to "inchargelogin.php"
header("location:inchargelogin.php");

// Destroy the session
session_destroy();

// Ensure that no further code is executed
exit;

?>