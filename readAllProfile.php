<?php

require_once("profile_controller.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read All Profile</title>
</head>
<body>
<h1 class="title">Read All Profile</h1>

<div class="container">

    <table cellspacing=0 border=1>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Profile Picture</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Password</th>
            <th>Tipe User</th>
        </tr>

        <?php
        $readAllProfile = readAllProfile();
        foreach ($readAllProfile as $read) {
        ?>
            <tr>
                <td><?= $read['id'] ?></td>
                <td><?= $read['user_id'] ?></td>
                <td><?= $read['profile_picture'] ?></td>
                <td><?= $read['nama'] ?></td>
                <td><?= $read['email'] ?></td>
                <td><?= $read['password'] ?></td>
                <td><?= $read['tipe_user'] ?></td>
            </tr>
        <?php } ?>
    </table>

</div>
</body>
</html>