<?php
require_once("stockItem_controller.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock Image</title>
</head>

<body>
    <form action="addStockItem.php" method="POST" enctype="multipart/form-data">
        <label>Judul : </label><input type="text" name="judul"><br />
        <label>Deskripsi Gambar : </label><input type="text" name="deskripsi"><br />
        <label>Gambar : </label><input type="file" name="gambar" accept="image/jpg, image/jpeg, image/png"><br />
        <label>Harga : </label><input type="number" name="harga"><br />
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $gambar_data = file_get_contents($_FILES['gambar']['tmp_name']);
        $harga = $_POST['harga'];

        createImageData($judul, $deskripsi, $gambar_data, $harga);
    }
    ?>
</body>

</html>