<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Stock Item</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
    <link rel="stylesheet" href="uploadImagePage_style.css">
    <script src="http://code.jquery.com/jquery.js"></script>
</head>

<body>
    <?php
    require_once("stockItem_controller.php");
    
    session_start();
    if (empty($_SESSION['user_id'])) {
        require_once("websiteHeader.html");
        header("location: loginPage.php");
    } else {
        require_once("websiteHeader_after.html");
    }

    $category_available_list = getCategoryList();

    if (isset($_POST['upload'])) {
        if (isset($_POST['kategori'])) {
            session_start();
            $user_id = $_SESSION['user_id'];
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $kategori = $_POST['kategori'];
            $gambar_name = $_FILES['gambar']['name'];
            $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
            $mime = mime_content_type($_FILES['gambar']['tmp_name']);

            if (($_FILES['gambar']['name'] != "")) {
                $item_id = createStockItem($user_id, $judul, $deskripsi, $harga, $kategori, $gambar_name, $gambar_tmp_name, $mime);
                header("location: collection.php");
            }
        } else {
            echo "No category has been selected";
        }
    }
    ?>

    <div class="container">
        <div class="header">
            <h2 class="animation a1">Upload an image</h2>
            <h4 class="animation a2">Start selling your artwork</h4>
        </div>

        <form class="form" action="uploadImagePage.php" method="post" enctype="multipart/form-data">
            <input type="text" class="form-field animation a3" name="judul" placeholder="Title" required>
            <input type="text" class="form-field animation a4" name="deskripsi" placeholder="Description" required>

            <div class="setImage animation a5">
                <p>Choose an image:&nbsp;&nbsp;</p>
                <input type="file" name="gambar" placeholder="Image" accept="image/jpg, image/jpeg, image/png" required>
            </div>

            <br />

            <label class="animation a6">Kategori : </label><br />
            <div class="category animation a7">

                <?php
                $list_count = 0;
                foreach ($category_available_list as $category) {
                    // if ($list_count % 5 === 0 && $list_count !== 0) {
                    //     echo "<br />";
                    // }
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
                    $list_count++;
                }
                ?>
            </div>

            <input type="text" class="form-field animation a8" name="harga" placeholder="Price" required>

            <input type="submit" class="form-button animation a9" name="upload" value="UPLOAD">
        </form>
    </div>

</body>

</html>