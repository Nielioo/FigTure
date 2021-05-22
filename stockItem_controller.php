<?php
require_once("db_controller.php");

function createImageData($judul, $deskripsi, $harga, $kategori, $gambar_name, $gambar_tmp_name, $mime) {
    $connection = connect();

    if ($connection != null) {
        if (!is_null($judul) && !is_null($deskripsi) && !is_null($harga) && !is_null($kategori) && !is_null($gambar_name) && !is_null($gambar_tmp_name) && !is_null($mime)) {
            // Image Properties
            // $image_name = $_FILES['gambar']['name'];
            // $image_tmp_name = $_FILES['gambar']['tmp_name'];
            // // $image_format = $_FILES['gambar']['type'];
            // // $image_type = mime_content_type($_POST['gambar']);
            // $image_size = $_FILES['gambar']['size'];
            // $image_error = $_FILES['gambar']['error'];

            // Check image type
            $mime_type = explode("/", $mime, 2);

            if (validateType($mime_type)) {
                // Add image file to image_file
                $target_dir = "stock_item/";
                $path = pathinfo($_FILES['gambar']['name']);
                $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
                $basename = $path['basename'];
                $path_basename = $target_dir . $basename;

                if (!file_exists($path_basename)) {
                    move_uploaded_file($gambar_tmp_name, $path_basename);

                    $query = $connection->prepare("INSERT INTO `image_file`(`gambar`) VALUES (?)");
                    $query->bind_param("s", $path_basename);
                    $query->execute() or die(mysqli_error($connection));
                    // Get insert id from image_file
                    $image_id = $connection->insert_id;
                }

                // FIXME Add image category to image_category
                // TODO kategori & type
                $query = $connection->prepare("INSERT INTO `image_category`(`category`) VALUES (?)");
                $query->bind_param("s", $kategori);
                $result = $query->execute() or die(mysqli_error($connection));
                // Get insert id from image_category
                $category_id = $connection->insert_id;


                // Add stock item to stock_item
                // Get type_id
                $type_id = getTypeID($mime_type[1]);

                $query = $connection->prepare("INSERT INTO `stock_item`(`user_id`, `data_id`, `image_id`, `category_id`, `type_id`) VALUES (?, ?, ?, ?, ?)");
                $query->bind_param("siiii", $user_id, $data_id, $image_id, $category_id, $type_id);
                $result = $query->execute() or die(mysqli_error($connection));
            }
        }
    }

    close($connection);

    // // Add image data to image_data
    // $query = $connection->prepare("INSERT INTO `image_data`(`judul`, `deskripsi`, `harga`) VALUES (?, ?, ?)");
    // $query->bind_param("ssi", $judul, $deskripsi, $harga);
    // $result = $query->execute() or die(mysqli_error($connection));
    // // Get insert id from image_data
    // $data_id = $connection->insert_id;
}

function validateType($mime_type) {
    $allowed_type = array("image");
    $allowed_ext = array("jpg", "jpeg", "png");

    if (in_array($mime_type[0], $allowed_type) && in_array($mime_type[1], $allowed_ext)) {
        
    }
}

function getTypeID($type) {
    $allowed_ext = array("jpg", "jpeg", "png");

    switch ($type) {
        case $allowed_ext[0]:
        case $allowed_ext[1]:
            
            break;
        case $allowed_ext[2]:
            break;
        default:
            return -1;
            break;
    }
}
?>