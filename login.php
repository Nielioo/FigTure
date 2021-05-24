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
    <title>Login</title>
</head>

<body>
    <!-- halo -->
    <form action="login.php" method="post">
        email <input type="text" name="email"><br>
        password <input type="password" name="password"><br>

        <input type="submit" name="login" value="login">
    </form>

    <?php
    if (isset($_POST['login'])) {
        $conn = connect();

        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = $conn->prepare("SELECT `user_id`, `email`, `password` FROM `user_profile` WHERE `email` =? AND `password`=?;");
        $query->bind_param('ss', $email, $password);
        $query->execute() or die(mysqli_error($conn));

        $result = $query->get_result();
        $data = $result->fetch_assoc();

        if (!empty($data)) {
            session_start();
            $_SESSION['user_id'] = $data['user_id'];
            echo "[session] user_id = " . $_SESSION['user_id'];
        } else {
            echo "user_id not found";
        }
    }
    ?>
</body>

</html>