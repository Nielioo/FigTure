<?php

require_once("profile_controller.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>

<body>
    <h1 class="title">Create New Message</h1>

    <div class="container">

        <form action="create.php" method="post">
            <table cellspacing=0>
                <tr>
                    <td>User ID</td>
                    <td><input type="text" name="user_id" required></td>
                </tr>
                <tr>
                    <td>Profile Picture</td>
                    <td><input type="file" name="profile_picture" accept="image/jpg, image/jpeg, image/png" required></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td>Tipe User</td>
                    <td>
                    <input type="radio" id="buyer" name="buyer" value="buyer">Buyer
                    <input type="radio" id="seller" name="seller" value="seller">Seller
                    </td>
                </tr>
            </table> <br>
            <input type="submit" name="create" value="Create Account">
        </form>

    </div>

    <?php
    if (isset($_POST['create'])) {
        $user_id = $_POST['user_id '];
        $profile_picture = file_get_contents($_FILES['pp']['tmp_name']);
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tipe_user = $_POST['tipe_user'];

        createProfile($user_id, $profile_picture, $nama, $email, $password, $tipe_user);
    }
    ?>
</body>

</html>