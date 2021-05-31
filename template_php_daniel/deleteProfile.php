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
    <title>Delete Profile</title>
</head>
<body>
    <h1>Delete Profile</h1>

    <form action="deleteProfile.php" method="post" enctype="multipart/form-data">
        <input type="submit" name="delete" value="Delete Profile">
    </form>

    <?php 
    if(isset($_POST['delete'])){
        session_start();
        $user_id = $_SESSION['user_id'];

        deleteProfile($user_id);
        session_destroy();
        echo $user_id." has been deleted.";
    }
    ?>

</body>
</html>