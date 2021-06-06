<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit image</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
    <link rel="stylesheet" href="editImagePage_style.css">
    <script src="http://code.jquery.com/jquery.js"></script>
</head>

<body>
    <?php
    require_once("stockItem_controller.php");

    session_start();
    if (empty($_SESSION['user_id'])) {
        require_once("websiteHeader.html");
    } else {
        require_once("websiteHeader_after.html");
    }

    $category_available_list = getCategoryList();

    $image_id = $_GET['image_id'];

    if (empty($image_id)) {
        header("location: collection.php");
    }

    $image_data = readStockItemByImageId($image_id);
    $image = $image_data[0];

    if (isset($_POST['save'])) {
        if (isset($_POST['kategori'])) {
            // Image cannot be edited as it may interrupt the list of items someone bought

            $user_id = $_SESSION['user_id'];
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $kategori = $_POST['kategori'];
            $image_id = $_POST['image_id'];

            updateStockItemByImageId($user_id, $judul, $deskripsi, $harga, $kategori, $image_id);
            header("location: profilePage.php");
        } else {
            echo "No category has been selected";
        }
    }
    ?>

    <div class="container">
        <div class="header">
            <h2 class="animation a1">Edit image data</h2>
            <h4 class="animation a2">Change your image details</h4>
        </div>

        <form class="form" method="post" enctype="multipart/form-data">
            <input type="text" class="form-field animation a3" name="judul" value="<?= $image['judul'] ?>" placeholder="Title" required>
            <input type="text" class="form-field animation a4" name="deskripsi" value="<?= $image['deskripsi'] ?>" placeholder="Description" required>

            <div class="editImage animation a5">
                <img src="<?= $image['gambar'] ?>">
            </div>

            <br />

            <label class="animation a6">Categories : </label><br />
            <div class="category animation a7">

                <?php
                $list_count = 0;
                foreach ($category_available_list as $category) {
                    if (in_array($category, $image['category'])) {
                ?>
                        <div class="checkbox">
                            <div>
                                <input type="checkbox" id="<?= $category ?>" name="kategori[]" value="<?= $category ?>" checked>
                                <div>
                                    <label for="<?= $category ?>"><?= $category ?></label>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="checkbox">
                            <div>
                                <input type="checkbox" id="<?= $category ?>" name="kategori[]" value="<?= $category ?>">
                                <div>
                                    <label for="<?= $category ?>"><?= $category ?></label>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    $list_count++;
                }
                ?>
            </div>

            <input type="text" class="form-field animation a8" name="harga" value="<?= $image['harga'] ?>" placeholder="$ Price" required>

            <input type="hidden" name="image_id" value="<?= $image_id ?>">

            <input type="submit" class="form-button animation a9" name="save" value="SAVE CHANGES">
        </form>
    </div>

</body>

</html>