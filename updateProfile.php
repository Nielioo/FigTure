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
    <title>Update Profile</title>
</head>

<body>

    <h1 class="title">Update Profile</h1>

    <?php
    session_start();
    $user_id = $_SESSION['user_id'];

    $readProfile = readProfile($user_id);
    ?>

    <div class="container">

        <form action="updateProfile.php" method="post" enctype="multipart/form-data">
            <table cellspacing=0>
                <tr>
                    <td>User ID</td>
                    <td><input type="text" name="user_id" value="<?=$readProfile['user_id']?>"></td>
                </tr>
                <tr>
                    <td>Profile Picture</td>
                    <td><input type="file" name="profile_picture" accept="image/jpg, image/jpeg, image/png" value="<?=$readProfile['profile_picture']?>"></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" value="<?=$readProfile['nama']?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?=$readProfile['email']?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" value="<?=$readProfile['password']?>"></td>
                </tr>
                <tr>
                    <td>Tipe User</td>
                    <td>
                        <input type="hidden" name="tipe_user" value="<?=$readProfile['tipe_user']?>">
                        <input type="radio" id="buyer" name="tipe_user" value="buyer">Buyer
                        <input type="radio" id="seller" name="tipe_user" value="seller">Seller
                    </td>
                </tr>
            </table> <br>
            <input type="submit" name="update" value="Update Account">
        </form>

    </div>

    <?php
    if (isset($_POST['update'])) {
        session_start();
        $user_id = $_SESSION['user_id'];

        $newUser_id = $_POST['user_id'];
        $profile_picture_name = $_FILES['profile_picture']['name'];
        $profile_picture_tmp_name = $_FILES['profile_picture']['tmp_name'];
        $mime = mime_content_type($_FILES['profile_picture']['tmp_name']);
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tipe_user = $_POST['tipe_user'];

        updateProfile($user_id, $newUser_id, $profile_picture_name, $profile_picture_tmp_name, $mime, $nama, $email, $password, $tipe_user);
        $_SESSION['user_id'] = $newUser_id;
    }
    ?>

</body>

</html>