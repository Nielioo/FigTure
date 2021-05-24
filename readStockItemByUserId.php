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
    <style>
        img {
            max-width: 75;
            max-height: 100;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['search'])) {
        session_start();
        $user_id = $_SESSION['user_id'];
        $image_list = readStockItemByUserId($user_id);
    ?>
        <table cellspacing=0 border=1>
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
        }
        ?>

        <form method="POST">
            <input type="submit" id="search" name="search" value="Search">
        </form>
</body>

</html>