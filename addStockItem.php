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
        <label>Kategori : </label>
        <input type="checkbox" id="people" name="kategori[]" value="people"><label for="people">People</label>
        <input type="checkbox" id="animal" name="kategori[]" value="animal"><label for="animal">Animal</label><br />
        <label>Harga : </label><input type="number" name="harga"><br />
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    // TODO add max file size on upload
    // https://stackoverflow.com/questions/6327965/html-upload-max-file-size-does-not-appear-to-work

    if (isset($_POST['submit'])) {
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $kategori = $_POST['kategori'];
        $gambar_name = $_FILES['gambar']['name'];
        $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
        $mime = mime_content_type($_FILES['gambar']['tmp_name']);

        if (($_FILES['gambar']['name'] != "")) {
            createImageData($judul, $deskripsi, $harga, $kategori, $gambar_name, $gambar_tmp_name, $mime);
        }
    }
    ?>
</body>

</html>