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
    <title>Read All Stock Item</title>
    <style>
        img {
            max-width: 75;
            max-height: 100;
            object-fit: cover;
        }

        table, th, tr, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
    $image_list = readAllStockItem();
    ?>
    <br />
    <table>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Tipe</th>
            <th>Kategori</th>
        </tr>
        <?php
        foreach ($image_list as $image) {
            $category_list = implode(",", $image['category']);
        ?>
            <tr>
                <td><?= $image['judul'] ?></td>
                <td><?= $image['deskripsi'] ?></td>
                <td><?= $image['harga'] ?></td>
                <td><img src="<?= $image['gambar'] ?>"></td>
                <td><?= $image['type'] ?></td>
                <td><?= $category_list ?></td>
            </tr>
        <?php
        }
        ?>
</body>

</html>