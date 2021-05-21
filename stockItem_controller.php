<?php

require_once("db_controller.php");
// header("Content-Type: application/json");

function createImageData($judul, $deskripsi, $gambar_data, $harga) {
    $connection = connect();

    if ($connection != null) {
        if (!is_null($judul) && !is_null($deskripsi) && !is_null($gambar_data) && !is_null($harga)) {
            // Convert images to BLOB
            // $image_name = $_FILES['gambar']['name'];
            // $image_tmp_name = $_FILES['gambar']['tmp_name'];
            // // $image_format = $_FILES['gambar']['type'];
            // // $image_type = mime_content_type($_POST['gambar']);
            // $image_size = $_FILES['gambar']['size'];
            // $image_error = $_FILES['gambar']['error'];

            // Add images to database
            // Directly
            // $query = "INSERT INTO `image_data`(`judul`, `deskripsi`, `gambar`, `harga`) VALUES ('$judul', '$deskripsi', '$gambar_data', '$harga')";
            // $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

            // Prepare
            $query = $connection->prepare("INSERT INTO `image_data`(`judul`, `deskripsi`, `gambar`, `harga`) VALUES (?, ?, ?, ?)");
            
            $null = NULL;
            $query->bind_param("ssbi", $judul, $deskripsi, $null, $harga);
            $query->send_long_data(2, $gambar_data);
            $query->execute() or die(mysqli_error($connection));

            // $result = $query->get_result();

            // if ($result) {
            //     $response['message'] = "Stock image created";
            // } else {
            //     $response['message'] = "Failed to create stock image";
            // }
        } else {
            // $response['message'] = "Required stock image data is not found";
        }
    } else {
        // $response['message'] = "Failed to connect to database";
    }

    close($connection);

    // echo json_encode($response);
}
?>