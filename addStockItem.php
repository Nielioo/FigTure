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

    // // This is the file we're going to add it in the database
    // $MY_FILE = $_FILES['file']['tmp_name'];

    // // To open the file and store its contents in $file_contents
    // $file = fopen($MY_FILE, 'r');
    // $file_contents = fread($file, filesize($MY_FILE));
    // fclose($file);
    // /* We need to escape some stcharacters that might appear in  file_contents,so do that now, before we begin the query.*/

    // $file_contents = addslashes($file_contents);

    // // To add the file in the database
    // // mysql_query("INSERT INTO files SET file_data='$file_contents'")
    ?>
</body>

</html>