<?php
require_once("stockItem_controller.php");
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
    require_once("websiteHeader.html");

    if (isset($_POST['submit'])) {
        $user_id = $_POST['user_id'];
        // $user_id = $_SESSION['user_id'];

        readStockItemByUserId($user_id);
    }
    ?>

    <form action="addStockItem.php" method="POST" enctype="multipart/form-data">
        <label>user_id : </label><input type="text" name="user_id" required><br />
        <input type="submit" id="submit" name="submit" value="Search">
    </form>
</body>

</html>