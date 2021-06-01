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
    <title>Profile Page</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
    <link rel="stylesheet" href="profilePage_style.css">
</head>

<body>

    <?php
    session_start();
    $user_id = $_SESSION['user_id'];

    $readProfile = readProfile($user_id);
    ?>

    <div class="container">
        <div class="profile-header">

            <div class="profile-img">
                <img src="<?= $readProfile['profile_picture'] ?>" width="200px">
            </div>
            <div class="profile-nav">
                <p class="username"><?= $readProfile['user_id'] ?></p>
                <div class="other-info">
                    <p class="tipe-user"><?= $readProfile['tipe_user'] ?></p>
                </div>
            </div>
            <div class="profile-option">
                <div class="notification">
                    <!-- <i class="fa-solid fa-bell"></i> -->
                    <span class="alert-message">1</span>
                </div>
            </div>

        </div>
        <div class="main-body">
            <div class="left">
                <div class="profile-side">
                    <table cellspacing = 0 border="0" class="profile-info">
                        <tr>
                            <th><p>Nama</p></th>
                            <td><p><?= $readProfile['nama'] ?></p></td>
                        </tr>
                        <tr>
                            <th><p>Email</p></th>
                            <td><p><?= $readProfile['email'] ?></p></td>
                        </tr>
                        <tr>
                        <th style="vertical-align: top;"><p>Bio</p></th>
                        <td><p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Ut laudantium reprehenderit quos tempora eos perferendis porro praesentium eaque sequi,
                        doloribus sit quibusdam, a consequuntur!
                        </p></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="right">
                <div class="nav">
                    <ul>
                        <li onclick="tabs(0)" class="user-post">Posts</li>
                        <li onclick="tabs(1)" class="user-review">Reviews</li>
                        <li onclick="tabs(2)" class="user-setting">Settings</li>
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="profile-post">
                        <h1>kolom buat Bryan</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Eaque impedit ullam praesentium, ex ut consequatur expedita consectetur.
                            Tempora, officiis! Repellat?</p>
                    </div>

                    <div class="profile-review">
                        <h1>kolom buat Gavin</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Eaque impedit ullam praesentium, ex ut consequatur expedita consectetur.
                            Tempora, officiis! Repellat?</p>
                    </div>

                    <div class="profile-setting">
                        <h1>kolom ku buat setting user</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Eaque impedit ullam praesentium, ex ut consequatur expedita consectetur.
                            Tempora, officiis! Repellat?</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="./jquery/profile_jquery.js"></script>
    <script src="./profilePage.js"></script>

    <?php
    echo "id = " . $readProfile['id'] . "<br>";
    echo "user_id = " . $readProfile['user_id'] . "<br>";
    echo "profile picture = " . "<img src=" . $readProfile['profile_picture'] . ">" . "<br>";
    echo "nama = " . $readProfile['nama'] . "<br>";
    echo "email = " . $readProfile['email'] . "<br>";
    echo "password = " . $readProfile['password'] . "<br>";
    echo "tipe user = " . $readProfile['tipe_user'] . "<br>";
    ?>


</body>

</html>