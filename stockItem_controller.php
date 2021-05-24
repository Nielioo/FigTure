<?php
require_once("db_controller.php");

// TODO Get category list from database

function createStockItem($user_id, $judul, $deskripsi, $harga, $kategori, $gambar_name, $gambar_tmp_name, $mime)
{
    $item_id = -1;

    $connection = connect();

    if ($connection != null) {
        if (!is_null($user_id) && !is_null($judul) && !is_null($deskripsi) && !is_null($harga) && !is_null($kategori) && !is_null($gambar_name) && !is_null($gambar_tmp_name) && !is_null($mime)) {
            // Check image type
            strtolower($mime);
            $mime_type = explode("/", $mime, 2);

            if (validateType($mime_type)) {
                // Add image file to image_file
                $target_dir = "stock_item/";
                $path = pathinfo($_FILES['gambar']['name']);
                $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
                $basename = $path['basename'];
                $path_basename = $target_dir . nowFileFormat() . "_" . str_replace(' ', '_', $basename);

                if (!file_exists($path_basename)) {
                    move_uploaded_file($gambar_tmp_name, $path_basename);

                    $query = $connection->prepare("INSERT INTO `image_file`(`gambar`) VALUES (?)");
                    $query->bind_param("s", $path_basename);
                    $query->execute() or die(mysqli_error($connection));
                    // Get insert id from image_file
                    $image_id = $connection->insert_id;

                    // Add image category to image_category
                    if (validateCategory($kategori)) {
                        $category_id_list = getCategoryID($kategori);

                        foreach ($category_id_list as $category_id) {
                            $query = $connection->prepare("INSERT INTO `image_category`(`image_id`, `category_id`) VALUES (?, ?)");
                            $query->bind_param("ii", $image_id, $category_id);
                            $result = $query->execute() or die(mysqli_error($connection));
                        }
                    } else {
                        failedToValidate("category");
                    }


                    // Get type_id
                    $type_id = getTypeID($mime_type[1]);


                    // Add stock item to stock_item
                    $query = $connection->prepare("INSERT INTO `stock_item`(`user_id`, `judul`, `deskripsi`, `harga`, `image_id`, `type_id`) VALUES (?, ?, ?, ?, ?, ?)");
                    $query->bind_param("sssiii", $user_id, $judul, $deskripsi, $harga, $image_id, $type_id);
                    $result = $query->execute() or die(mysqli_error($connection));
                    // Get insert id from stock_item
                    $item_id = $connection->insert_id;
                } else {
                    echo "File exists";
                }
            } else {
                failedToValidate("type");
            }
        } else {
            dataIsNull("create stock item");
        }
    } else {
        failedToConnect();
    }

    close($connection);

    return $item_id;

    // // Add image data to image_data
    // $query = $connection->prepare("INSERT INTO `image_data`(`judul`, `deskripsi`, `harga`) VALUES (?, ?, ?)");
    // $query->bind_param("ssi", $judul, $deskripsi, $harga);
    // $result = $query->execute() or die(mysqli_error($connection));
    // // Get insert id from image_data
    // $data_id = $connection->insert_id;

    // Image Properties
    // $image_name = $_FILES['gambar']['name'];
    // $image_tmp_name = $_FILES['gambar']['tmp_name'];
    // $image_format = $_FILES['gambar']['type'];
    // $image_type = mime_content_type($_POST['gambar']);
    // $image_size = $_FILES['gambar']['size'];
    // $image_error = $_FILES['gambar']['error'];
}

function readAllStockItem()
{
    $image_data = array();

    $connection = connect();

    if ($connection != null) {
        $query = $connection->prepare(
            "SELECT
                stock_item.judul,
                stock_item.deskripsi,
                stock_item.harga,
                stock_item.image_id,
                image_file.gambar,
                image_available_type.type,
                image_available_category.category
            FROM
                (`stock_item`, `image_category`)
            INNER JOIN image_file ON stock_item.image_id = image_file.id
            INNER JOIN image_available_type ON stock_item.type_id = image_available_type.id
            INNER JOIN image_available_category ON(
                    stock_item.image_id = image_category.image_id AND image_category.category_id = image_available_category.id
                )
            ORDER BY
                stock_item.id"
        );
        $query->execute() or die(mysqli_error($connection));

        $result = $query->get_result();
        if (!empty($result)) {
            $row_count = 0;
            while ($row = $result->fetch_assoc()) {
                $data['judul'] = $row['judul'];
                $data['deskripsi'] = $row['deskripsi'];
                $data['harga'] = $row['harga'];
                $data['image_id'] = $row['image_id'];
                $data['gambar'] = $row['gambar'];
                $data['type'] = $row['type'];
                $data['category'] = array();
                array_push($data['category'], $row['category']);

                if ($row_count > 0) {
                    if ($image_data[$row_count - 1]['gambar'] === $data['gambar']) {
                        array_push($image_data[$row_count - 1]['category'], $row['category']);
                    } else {
                        array_push($image_data, $data);
                        $row_count++;
                    }
                } else {
                    array_push($image_data, $data);
                    $row_count++;
                }
            }
        } else {
            dataIsNull("image list");
        }
    } else {
        failedToConnect();
    }

    close($connection);

    return $image_data;
}

function readStockItemByUserId($user_id)
{
    $image_data = array();

    $connection = connect();

    if ($connection != null) {
        if (!is_null($user_id)) {
            $query = $connection->prepare(
                "SELECT
                stock_item.judul,
                stock_item.deskripsi,
                stock_item.harga,
                stock_item.image_id,
                image_file.gambar,
                image_available_type.type,
                image_available_category.category
            FROM
                (`stock_item`, `image_category`)
            INNER JOIN image_file ON stock_item.image_id = image_file.id
            INNER JOIN image_available_type ON stock_item.type_id = image_available_type.id
            INNER JOIN image_available_category ON(
                    stock_item.image_id = image_category.image_id AND image_category.category_id = image_available_category.id
                )
            WHERE
                stock_item.user_id = ?
            ORDER BY
                stock_item.id"
            );
            $query->bind_param("s", $user_id);
            $query->execute() or die(mysqli_error($connection));

            $result = $query->get_result();
            if (!empty($result)) {
                $row_count = 0;
                while ($row = $result->fetch_assoc()) {
                    $data['judul'] = $row['judul'];
                    $data['deskripsi'] = $row['deskripsi'];
                    $data['harga'] = $row['harga'];
                    $data['image_id'] = $row['image_id'];
                    $data['gambar'] = $row['gambar'];
                    $data['type'] = $row['type'];
                    $data['category'] = array();
                    array_push($data['category'], $row['category']);
                    // $data['category'] =  $row['category'];

                    if ($row_count > 0) {
                        if ($image_data[$row_count - 1]['gambar'] === $data['gambar']) {
                            array_push($image_data[$row_count - 1]['category'], $row['category']);
                        } else {
                            array_push($image_data, $data);
                            $row_count++;
                        }
                    } else {
                        array_push($image_data, $data);
                        $row_count++;
                    }
                }
            } else {
                dataIsNull("image list");
            }
        } else {
            dataIsNull("read stock item: user id");
        }
    } else {
        failedToConnect();
    }

    close($connection);

    return $image_data;
}

function readStockItemByImageId($image_id)
{
    $image_data = array();

    $connection = connect();

    if ($connection != null) {
        if (!is_null($image_id)) {
            $query = $connection->prepare(
                "SELECT
                stock_item.judul,
                stock_item.deskripsi,
                stock_item.harga,
                stock_item.image_id,
                image_file.gambar,
                image_available_type.type,
                image_available_category.category
            FROM
                (`stock_item`, `image_category`)
            INNER JOIN image_file ON stock_item.image_id = image_file.id
            INNER JOIN image_available_type ON stock_item.type_id = image_available_type.id
            INNER JOIN image_available_category ON(
                    stock_item.image_id = image_category.image_id AND image_category.category_id = image_available_category.id
                )
            WHERE
                stock_item.image_id = ?
            ORDER BY
                stock_item.id"
            );
            $query->bind_param("i", $image_id);
            $query->execute() or die(mysqli_error($connection));

            $result = $query->get_result();
            if (!empty($result)) {
                $row_count = 0;
                while ($row = $result->fetch_assoc()) {
                    $data['judul'] = $row['judul'];
                    $data['deskripsi'] = $row['deskripsi'];
                    $data['harga'] = $row['harga'];
                    $data['image_id'] = $row['image_id'];
                    $data['gambar'] = $row['gambar'];
                    $data['type'] = $row['type'];
                    $data['category'] = array();
                    array_push($data['category'], $row['category']);
                    // $data['category'] =  $row['category'];

                    if ($row_count > 0) {
                        if ($image_data[$row_count - 1]['gambar'] === $data['gambar']) {
                            array_push($image_data[$row_count - 1]['category'], $row['category']);
                        } else {
                            array_push($image_data, $data);
                            $row_count++;
                        }
                    } else {
                        array_push($image_data, $data);
                        $row_count++;
                    }
                }
            } else {
                dataIsNull("image list");
            }
        } else {
            dataIsNull("read stock item: image id");
        }
    } else {
        failedToConnect();
    }

    close($connection);

    return $image_data;
}

// FIXME Finish the if else condition etc
function updateStockItemByImageId($user_id, $judul, $deskripsi, $harga, $kategori, $gambar_name, $gambar_tmp_name, $mime, $image_id)
{
    $connection = connect();

    if ($connection != null) {
        if (!is_null($user_id) && !is_null($judul) && !is_null($deskripsi) && !is_null($harga)) {
            if (!is_null($gambar_name) && !is_null($gambar_tmp_name) && !is_null($mime)) {
                if (!is_null($kategori)) {
                    // Check image type
                    strtolower($mime);
                    $mime_type = explode("/", $mime, 2);

                    if (validateType($mime_type)) {
                        // Update image file to image_file
                        $target_dir = "stock_item/";
                        $path = pathinfo($_FILES['gambar']['name']);
                        $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
                        $basename = $path['basename'];
                        $path_basename = $target_dir . nowFileFormat() . "_" . str_replace(' ', '_', $basename);

                        if (!file_exists($path_basename)) {
                            move_uploaded_file($gambar_tmp_name, $path_basename);

                            $query = $connection->prepare("UPDATE `image_file` SET `gambar`=? WHERE `id`=?");
                            $query->bind_param("ss", $path_basename, $image_id);
                            $query->execute() or die(mysqli_error($connection));
                            // Get insert id from image_file
                            $image_id = $connection->insert_id;

                            // Update image category to image_category
                            foreach ($kategori as $category) {
                                if (validateCategory($category)) {
                                    $category_id = getCategoryID($category);

                                    if ($category_id > 0) {
                                        // FIXME updating category is not that simple for images with more than one category
                                        $query = $connection->prepare("UPDATE `image_category` SET `category_id`=? WHERE `image_id`=?");
                                        $query->bind_param("iis", $image_id, $category_id, $user_id);
                                        $query->execute() or die(mysqli_error($connection));
                                    } else {
                                        echo "category_id:" . $category_id  . " is not valid";
                                    }
                                } else {
                                    failedToValidate("category");
                                }
                            }


                            // Get type_id
                            $type_id = getTypeID($mime_type[1]);


                            // Update stock item to stock_item
                            $query = $connection->prepare("INSERT INTO `stock_item`(`user_id`, `judul`, `deskripsi`, `harga`, `image_id`, `type_id`) VALUES (?, ?, ?, ?, ?, ?)");
                            $query = $connection->prepare("UPDATE `stock_item` SET `user_id`=?,`judul`=?,`deskripsi`=?,`harga`=?,`image_id`=?,`type_id`=? WHERE `user_id`=?;");
                            $query->bind_param("sssiiis", $user_id, $judul, $deskripsi, $harga, $image_id, $type_id, $user_id);
                            $query->execute() or die(mysqli_error($connection));
                        } else {
                            echo "File exists";
                        }
                    }
                } else {
                    dataIsNull("kategori");
                }
            } else {
                dataIsNull("gambar");
            }
        } else {
            dataIsNull("update stock item");
        }
    } else {
        failedToConnect();
    }

    close($connection);
}

// TODO recheck
function deleteStockItemByUserId($user_id)
{
    $conn = connect();

    if ($conn != null) {
        $query = $conn->prepare("DELETE FROM `stock_item` WHERE `user_id`=?;");
        $query->bind_param("s", $user_id);
        $query->execute() or die(mysqli_error($conn));
    }
    close($conn);
}

function validateType($mime_type)
{
    $allowed_type = array("image");
    $allowed_ext = array("jpg", "jpeg", "png");

    return (in_array($mime_type[0], $allowed_type) && in_array($mime_type[1], $allowed_ext));
}

function getTypeList()
{
    $type_list = array();

    $connection = connect();

    if (!is_null($connection)) {
        $query = $connection->prepare("SELECT `type` FROM `image_available_type`");
        $query->execute();

        $result = $query->get_result();

        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $data = $row['type'];
                array_push($type_list, $data);
            }
        } else {
            dataIsNull("type list");
        }
    } else {
        failedToConnect();
    }

    close($connection);

    return $type_list;
}

function getTypeID($type)
{
    $allowed_ext = array("jpg", "jpeg", "png");
    $type_id = -1;

    switch ($type) {
        case $allowed_ext[0]:
        case $allowed_ext[1]:
            $type_id = 1;
            break;
        case $allowed_ext[2]:
            $type_id = 2;
            break;
        default:
            $type_id = -1;
            break;
    }

    return $type_id;
}

function validateCategory($category_list)
{
    foreach ($category_list as $category) {
        $category = ucfirst(strtolower($category));
        $available_category = getCategoryList();

        if (!in_array($category, $available_category)) {
            return false;
        }
    }

    return true;
}

function getCategoryList()
{
    $category_list = array();

    $connection = connect();

    if (!is_null($connection)) {
        $query = $connection->prepare("SELECT `category` FROM `image_available_category`");
        $query->execute();

        $result = $query->get_result();

        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $data = $row['category'];
                array_push($category_list, $data);
            }
        } else {
            dataIsNull("category list");
        }
    } else {
        failedToConnect();
    }

    close($connection);

    return $category_list;
}

function getCategoryID($category_list)
{
    $category_id_list = array();

    $connection = connect();

    foreach ($category_list as $category) {
        $category = ucfirst(strtolower($category));

        if (!is_null($connection)) {
            $query = $connection->prepare("SELECT `id` FROM `image_available_category` WHERE `category`=?");
            $query->bind_param("s", $category);
            $query->execute();

            $result = $query->get_result();
            $data = $result->fetch_assoc();

            if (!empty($data)) {
                array_push($category_id_list, $data['id']);
            } else {
                dataIsNull("category id");
            }
        } else {
            failedToConnect();
        }
    }

    close($connection);


    return $category_id_list;
}

function dataIsNull($string)
{
    echo "Some " . $string . " data are NULL";
}

function failedToValidate($string)
{
    echo "Failed to validate " . $string;
}

function failedToConnect()
{
    echo "Failed connecting to database";
}
