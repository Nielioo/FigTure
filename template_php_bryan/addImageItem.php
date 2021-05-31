<?php
require_once("db_controller.php");
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
    <form action="addImageItem.php" method="POST" enctype="multipart/form-data">
        <label>Gambar : </label><input type="file" name="gambar" accept="image/jpg, image/jpeg, image/png"><br />
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $connection = connect();

        // Without prepare
        // $gambar_data = mysqli_real_escape_string($connection, file_get_contents($_FILES['gambar']['tmp_name']));

        // if (!is_null($connection)) {
        //     $query = "INSERT INTO `image_file` (`gambar`) VALUES ('$gambar_data')";
        //     $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        //     echo "upload success";
        // } else {
        //     echo "error occured";
        // }

        // With prepare
        // $gambar_data = file_get_contents($_FILES['gambar']['tmp_name']);

        // $query = $connection->prepare("INSERT INTO `image_file`(`gambar`) VALUES (?)");
        // $null = NULL;
        // $query->bind_param("b", $null);
        // $query->send_long_data(0, $gambar_data);
        // $query->execute() or die(mysqli_error($connection));

        // $stmt = $connection->prepare("INSERT INTO image_file (gambar) VALUES(?)");
        // $null = NULL;
        // $stmt->bind_param("b", $null);
        // $stmt->send_long_data(0, mysqli_real_escape_string($connection, file_get_contents($_FILES['gambar']['tmp_name'])));
        // $stmt->execute();

        // $id = 1;

        // $stmt = $connection->prepare("SELECT gambar FROM image_file WHERE id=?");
        // $stmt->bind_param("i", $id);
        // $stmt->execute();
        // $stmt->store_result();
        // $stmt->bind_result($image);
        // $stmt->fetch();

        // echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" />';
        // echo 'Hello world.';

        $gambar_name = $_FILES['gambar']['name'];

        if (($_FILES['gambar']['name'] != "")) {
            $target_dir = "stock_item/";
            $path = pathinfo($_FILES['gambar']['name']);
            $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
            $basename = $path['basename'];
            $path_basename = $target_dir . $basename;

            if (!file_exists($path_basename)) {
                $query = $connection->prepare("INSERT INTO `image_file`(`gambar`) VALUES (?)");
                $query->bind_param("s", $path_basename);
                $query->execute() or die(mysqli_error($connection));

                move_uploaded_file($gambar_tmp_name, $path_basename);
            }
        }
    }
    ?>

    <img src="<?=$path_basename?>">
</body>

</html>