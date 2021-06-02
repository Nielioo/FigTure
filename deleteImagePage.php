<?php
    require_once("stockItem_controller.php");

    session_start();
    if (empty($_SESSION['user_id'])) {
        header("location: loginPage.php");
    }

    $user_id = $_SESSION['user_id'];
    $image_id = $_GET['image_id'];

    if (empty($image_id)) {
        header("location: collection.php");
    } else {
        deleteStockItemByImageId($user_id, $image_id);
        header("location: profilePage.php");
    }
    ?>