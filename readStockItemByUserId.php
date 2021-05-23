<?php
require_once("stockItem_controller.php");
require_once("websiteHeader.html");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Stock Image</title>
</head>

<body>
    <?php
    if (isset($_POST['search'])) {
        session_start();
        $user_id = $_SESSION['user_id'];

        readStockItemByUserId($user_id);
    }
    ?>

    <form action="readStockItemByUserId.php" method="POST" enctype="multipart/form-data">
        <input type="submit" id="search" name="search" value="Search">
    </form>
</body>

</html>