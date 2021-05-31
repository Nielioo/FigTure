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
    <title>Register Page</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
    <link rel="stylesheet" href="login_register_style.css">
</head>

<body>

    <div class="container">
        <div class="left"></div>

        <div class="right">
            <div class="header">
                <h2 class="animation a1">Create an Account</h2>
                <h4 class="animation a2">Register new Figture account</h4>
            </div>

            <form class="form" action="registerPage.php" method="post" enctype="multipart/form-data">
                <input type="text" class="form-field animation a3" name="user_id" placeholder="User ID" required>
                <input type="text" class="form-field animation a4" name="nama" placeholder="Your Name" required>
                <input type="email" class="form-field animation a5" name="email" placeholder="Email Address" required>
                <input type="password" class="form-field animation a6" name="password" placeholder="Password" required>

                <div class="setProfilePicture animation a7">
                    <p>Set Profile Picture:&nbsp;&nbsp;</p>
                    <input type="file" name="profile_picture" placeholder="Profile Picture" accept="image/jpg, image/jpeg, image/png" required>
                </div>

                <div class="radioButton animation a8">
                    <p>Choose your role:&nbsp;&nbsp;</p>
                    <input type="radio" id="buyer" name="tipe_user" value="buyer">
                    <p>Visitor&nbsp;&nbsp;</p>
                    <input type="radio" id="seller" name="tipe_user" value="seller">
                    <p>Creator</p>
                </div>

                <input type="submit" class="form-button animation a9" name="create" value="REGISTER">

                <p class="reglog animation a10">Already have an account? <a href="loginPage.php">Login Here</a></p>
            </form>
            
            <?php
            if (isset($_POST['create'])) {
                $user_id = $_POST['user_id'];
                $profile_picture_name = $_FILES['profile_picture']['name'];
                $profile_picture_tmp_name = $_FILES['profile_picture']['tmp_name'];
                $mime = mime_content_type($_FILES['profile_picture']['tmp_name']);
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $tipe_user = $_POST['tipe_user'];

                createProfile($user_id, $profile_picture_name, $profile_picture_tmp_name, $mime, $nama, $email, $password, $tipe_user);
            }
            ?>

        </div>
    </div>

</body>

</html>