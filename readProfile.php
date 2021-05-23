<?php

require_once("profile_controller.php");
require_once("websiteHeader.html");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Profile</title>
    <style>
        img{
            width: 75;
            height: 75;
        }

    </style>
</head>

<body>

    <h1>Read Profile</h1>

    <?php
    session_start();
    $user_id = $_SESSION['user_id'];

    $readProfile = readProfile($user_id);

    echo "id = ".$readProfile['id']."<br>";
    echo "user_id = ".$readProfile['user_id']."<br>";
    echo "profile picture = "."<img src=" . $readProfile['profile_picture'] . ">"."<br>";
    echo "nama = ".$readProfile['nama']."<br>";
    echo "email = ".$readProfile['email']."<br>";
    echo "password = ".$readProfile['password']."<br>";
    echo "tipe user = ".$readProfile['tipe_user']."<br>";
    ?>

</body>

</html>