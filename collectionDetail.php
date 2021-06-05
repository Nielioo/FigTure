<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Details</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
    <link rel="stylesheet" href="collectionDetail_style.css">
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
    ?>

    <div class="page">
        <div class="container">
            <div class="flex_container">
                <div class="left_container">
                    <?php
                    $image_id = $_GET['image_id'];

                    if (empty($image_id)) {
                        header("location: collection.php");
                    }

                    $image_data = readStockItemByImageId($image_id);
                    $image = $image_data[0]; // TODO Risky index 0, need to be tested more
                    $category_list = implode(", ", $image['category']);
                    ?>
                    <figure class="collection_figure">
                        <img src="<?= $image['gambar'] ?>" id="image" class="collection_image">
                    </figure>
                </div>
                <div class="right_container">
                    <div class="image_file">
                        <h4>File dimension</h4>
                        <label id="image_dimension"></label><br /><br /><br />
                        <h4>File format</h4>
                        <label><?= $image['type'] ?></label><br />
                    </div>
                    <div class="image_purchase">
                        <h4>Price</h4>
                        <label>$<?= $image['harga'] ?></label><br /><br />
                        <a href="#" class="purchase_link">Purchase image</a>
                    </div>
                </div>
            </div>
            <div class="image_info">
                <h3 class="image_title"><?= $image['judul'] ?></h3>
                <hr />
                <div class="image_description">
                    <h4>Description</h4>
                    <?= $image['deskripsi'] ?>
                </div>
                <hr />
                <div class="image_category">
                    <h4>Categories</h4>
                    <?= $category_list ?>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(
            function() {
                const img = new Image();
                img.onload = function() {
                    $("#image_dimension").text(this.width + 'x' + this.height);
                }
                img.src = $("#image").attr("src");
            }
        );
    </script>
</body>

</html>