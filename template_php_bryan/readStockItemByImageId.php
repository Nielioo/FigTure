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
    <title>Read Stock Item</title>
    <style>
        img {
            max-width: 200px;
            max-height: 300px;
        }
    </style>
</head>

<body>
    <?php
    $image_id = $_GET['image_id'];
    $image_data = readStockItemByImageId($image_id);
    $image = $image_data[0]; // TODO Risky index 0, need to be tested more
    $category_list = implode(",", $image['category']);
    ?>

    <h1><?= $image['judul'] ?></h1>
    <img src="<?= $image['gambar'] ?>"><br />
    <h3>Tipe</h3>
    <p><?= $image['type'] ?></p>
    <h3>Deskripsi</h3>
    <p><?= $image['deskripsi'] ?></p>
    <h3>Harga</h3>
    <p><?= $image['harga'] ?></p>
    <h3>Kategori</h3>
    <p><?= $category_list ?></p>

    <!-- Cursor:Pointer in css for hand icon
    https://freefrontend.com/css-checkboxes/
    https://codepen.io/FlorinCornea/pen/poNBrzm
    https://www.w3schools.com/cssref/css_selectors.asp -->
</body>

</html>