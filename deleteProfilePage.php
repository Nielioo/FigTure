<?php

require_once("profile_controller.php");

session_start();
$user_id = $_SESSION['user_id'];

deleteProfile($user_id);
session_destroy();
echo $user_id . " has been deleted.";

header("location: homePage.php");

?>
