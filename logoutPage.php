<?php
session_start();
$_SESSION['user_id'] = $data['user_id'];
session_destroy();

header("location: homePage.php");
?>