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
    <title>Delete Stock Item</title>
    <style>
        img {
            max-width: 200px;
            max-height: 300px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $user_id = $_SESSION['user_id'];
    $image_id = $_GET['image_id'];
    $image_data = readStockItemByImageId($image_id);
    $image = $image_data[0]; // TODO Risky index 0, need to be tested more

    if (isset($_POST['btnCancel'])) {
        header("location: readStockItemByUserId.php");
    }

    if (isset($_POST['btnDelete'])) {
        deleteStockItemByImageId($user_id, $image_id);
        header("location: readStockItemByUserId.php");
    }
    ?>
    <br />
    <h2>Are you sure you want to delete <?= $image['judul'] ?> ?</h2>
    <h4>This action cannot be undone, please proceed with caution. User who has bought this item will still be able to keep this item in their library</h4>
    
    <form method="POST">
        <input type="submit" name="btnCancel" value="Cancel">
        <input type="submit" name="btnDelete" value="Delete">
    </form>

    <img src="<?= $image['gambar'] ?>">
</body>

</html>