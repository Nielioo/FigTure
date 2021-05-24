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
    <title>Update Stock Item</title>
</head>

<body>
    <?php
    // TODO add max file size on upload
    // https://stackoverflow.com/questions/6327965/html-upload-max-file-size-does-not-appear-to-work

    $image_id = $_GET['image_id'];
    $image_data = readStockItemByImageId($image_id);
    $image = $image_data[0]; // TODO Risky index 0, need to be tested more
    $category_list = implode(",", $image['category']);

    // Unused data from readStockItemByImageId
    // $image_data['gambar'];
    // $image_data['type'];
    // $category_list;

    if (isset($_POST['submit'])) {
        session_start();
        $user_id = $_SESSION['user_id'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $kategori = $_POST['kategori'];
        $gambar_name = $_FILES['gambar']['name'];
        $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
        $mime = mime_content_type($_FILES['gambar']['tmp_name']);
        $image_id = $_POST['image_id'];

        if (($_FILES['gambar']['name'] != "")) {
            updateStockItemByImageId($user_id, $judul, $deskripsi, $harga, $kategori, $gambar_name, $gambar_tmp_name, $mime, $image_id);
        }
    }
    ?>

    <form method="POST" enctype="multipart/form-data">
        <!-- TODO Checked the category -->

        <label>Judul : </label><input type="text" name="judul" value="<?= $image['judul'] ?>" required><br />
        <label>Deskripsi Gambar : </label><input type="text" name="deskripsi" value="<?= $image['deskripsi'] ?>" required><br />
        <label>Gambar : </label><input type="file" name="gambar" accept="image/jpg, image/jpeg, image/png" ><br />
        <label>Kategori : </label>
        <input type="checkbox" id="people" name="kategori[]" value="people"><label for="people">People</label>
        <input type="checkbox" id="animal" name="kategori[]" value="animal"><label for="animal">Animal</label><br />
        <label>Harga : </label><input type="number" name="harga" value="<?= $image['harga'] ?>" required><br />
        <input type="hidden" name="image_id" value="<?=$image_id?>">
        <input type="submit" id="submit" name="submit" value="Submit">

        <!-- Cursor:Pointer in css for hand icon
        https://freefrontend.com/css-checkboxes/
        https://codepen.io/FlorinCornea/pen/poNBrzm
        https://www.w3schools.com/cssref/css_selectors.asp -->
    </form>
</body>

</html>