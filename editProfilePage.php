<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
    <link rel="stylesheet" href="editProfilePage_style.css">
    <script src="http://code.jquery.com/jquery.js"></script>
</head>

<body>
    <?php

    require_once("profile_controller.php");
    require_once("websiteHeader_after.html");

    ?>

    <?php
    session_start();
    $user_id = $_SESSION['user_id'];

    if (empty($user_id)) {
        header("location: loginPage.php");
    }

    $readProfile = readProfile($user_id);
    ?>

    <div class="container">

        <div class="left">
            <div class="header">
                <h2 class="animation a1">Edit Account Information</h2>
                <h4 class="animation a2">Use form bellow to edit your data</h4>
            </div>

            <form class="form" action="editProfilePage.php" method="post" enctype="multipart/form-data">
                <input type="text" class="form-field animation a3" name="user_id" value="<?= $readProfile['user_id'] ?>">
                <input type="text" class="form-field animation a4" name="nama" value="<?= $readProfile['nama'] ?>">
                <input type="email" class="form-field animation a5" name="email" value="<?= $readProfile['email'] ?>">
                <input type="password" class="form-field animation a6" name="password" value="<?= $readProfile['password'] ?>">

                <div class="setProfilePicture animation a7">
                    <p>Change Profile Picture:&nbsp;&nbsp;</p>
                    <input type="file" name="profile_picture" placeholder="Profile Picture" accept="image/jpg, image/jpeg, image/png">
                </div>

                <div class="radioButton animation a8">
                    <p>Change your role:&nbsp;&nbsp;</p>
                    <input type="hidden" name="tipe_user" value="<?= $readProfile['tipe_user'] ?>">
                    <input type="radio" id="buyer" name="tipe_user" value="visitor">
                    <p>Visitor&nbsp;&nbsp;</p>
                    <input type="radio" id="seller" name="tipe_user" value="creator">
                    <p>Creator</p>
                </div>

                <input onclick="updatedAlert()" type="submit" class="form-button animation a9" name="update" value="SAVE">

                <p class="back animation a10"><a href="profilePage.php">Back to Profile Page</a></p>
            </form>

            <?php
            if (isset($_POST['update'])) {
                $user_id = $_SESSION['user_id'];

                $newUser_id = $_POST['user_id'];
                $profile_picture_name = $_FILES['profile_picture']['name'];
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $tipe_user = $_POST['tipe_user'];

                if ($profile_picture_name != null) {
                    $profile_picture_tmp_name = $_FILES['profile_picture']['tmp_name'];
                    $mime = mime_content_type($_FILES['profile_picture']['tmp_name']);

                    updateProfile($user_id, $newUser_id, $profile_picture_name, $profile_picture_tmp_name, $mime, $nama, $email, $password, $tipe_user);
                    $_SESSION['user_id'] = $newUser_id;
                } else {
                    updateProfile_noPict($user_id, $newUser_id, $nama, $email, $password, $tipe_user);
                    $_SESSION['user_id'] = $newUser_id;
                }

                header("location: profilePage.php");
            }
            ?>

        </div>

        <div class="right">
            <h3>Previous Profile Picture</h3>
            <img class="image-preview" src="<?= $readProfile['profile_picture'] ?>">
        </div>

    </div>

    <script>
        function updatedAlert() {
            alert("Profile updated!");
        }
    </script>

</body>

</html>