<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
</head>

<body>
    <?php
    require_once("stockItem_controller.php");

    session_start();
    if (empty($_SESSION['user_id'])) {
        require_once("websiteHeader.html");
    } else {
        require_once("websiteHeader_after.html");
    }
    ?>
    About Us
</body>

</html>