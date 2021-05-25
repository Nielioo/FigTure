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
    <style>
        img {
            max-width: 200px;
            max-height: 300px;
        }
    </style>
</head>

<body>
    <?php
    // TODO add max file size on upload
    // https://stackoverflow.com/questions/6327965/html-upload-max-file-size-does-not-appear-to-work

    $category_available_list = getCategoryList();

    $image_id = $_GET['image_id'];
    $image_data = readStockItemByImageId($image_id);
    $image = $image_data[0]; // TODO Risky index 0, need to be tested more
    $category_list = implode(",", $image['category']);

    // Unused data from readStockItemByImageId
    // $image_data['gambar'];
    // $image_data['type'];
    // $category_list;

    if (isset($_POST['submit'])) {
        if (isset($_POST['kategori'])) {
            // Image cannot be edited as it may interrupt the list of items someone bought

            session_start();
            $user_id = $_SESSION['user_id'];
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $kategori = $_POST['kategori'];
            $image_id = $_POST['image_id'];

            updateStockItemByImageId($user_id, $judul, $deskripsi, $harga, $kategori, $image_id);
        } else {
            echo "No category has been selected";
        }
    }
    ?>

    <form method="POST" enctype="multipart/form-data">
        <!-- TODO Checked the category -->

        <label>Judul : </label><input type="text" name="judul" value="<?= $image['judul'] ?>" required><br />
        <label>Deskripsi Gambar : </label><input type="text" name="deskripsi" value="<?= $image['deskripsi'] ?>" required><br />
        <img src="<?= $image['gambar'] ?>"><br />
        <label>Kategori : </label><br />
        <?php
        $list_count = 0;
        foreach ($category_available_list as $category) {
            if ($list_count === 5) {
                echo "<br />";
            }
        ?>
            <input type="checkbox" id="<?= $category ?>" name="kategori[]" value="<?= $category ?>"><label for="<?= $category ?>"><?= $category ?></label>
        <?php
        }
        $list_count++;
        ?>
        <br />
        <label>Harga : </label><input type="number" name="harga" value="<?= $image['harga'] ?>" required><br />
        <input type="hidden" name="image_id" value="<?= $image_id ?>">
        <input type="submit" id="submit" name="submit" value="Submit">

        <!-- Cursor:Pointer in css for hand icon
        https://freefrontend.com/css-checkboxes/
        https://codepen.io/FlorinCornea/pen/poNBrzm
        https://www.w3schools.com/cssref/css_selectors.asp -->
    </form>
</body>

</html>