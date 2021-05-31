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
    <title>Read Stock Item List</title>
    <style>
        img {
            max-width: 75;
            max-height: 100;
            object-fit: cover;
        }

        table,
        th,
        tr,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    if (!empty($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $image_list = readStockItemByUserId($user_id);
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
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
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
                    <td><a href="readStockItemByImageId.php?image_id=<?= $image['image_id'] ?>">View</a></td>
                    <td><a href="updateStockItem.php?image_id=<?= $image['image_id'] ?>">Edit</a></td>
                    <td><a href="deleteStockItemByImageId.php?image_id=<?= $image['image_id'] ?>">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "Please login first";
    }
    ?>
</body>

</html>