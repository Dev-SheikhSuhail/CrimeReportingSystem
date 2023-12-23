<?php
session_start();
session_destroy();
header("location: headlogin.php");
exit();
?>