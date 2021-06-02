<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Image</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
    <link rel="stylesheet" href="deleteImagePage_style.css">
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

    $user_id = $_SESSION['user_id'];
    $image_id = $_GET['image_id'];

    if (empty($image_id)) {
        header("location: collection.php");
    }

    $image_data = readStockItemByImageId($image_id);
    $image = $image_data[0];

    if (isset($_POST['btnCancel'])) {
        header("location: profilePage.php");
    }

    if (isset($_POST['btnDelete'])) {
        deleteStockItemByImageId($user_id, $image_id);
        header("location: profilePage.php");
    }
    ?>
    <div class="container">
        <div class="text-container">
            <h2>Are you sure you want to delete <?= $image['judul'] ?> ?</h2><br />
            <h4>This action cannot be undone, please proceed with caution. User who has bought this item will still be able to keep this item in their library</h4>
        </div>
        <form method="POST">
            <input type="submit" name="btnCancel" value="Cancel">
            <input type="submit" name="btnDelete" value="Delete">
        </form>
        <br />

        <img src="<?= $image['gambar'] ?>">
    </div>

</body>

</html>