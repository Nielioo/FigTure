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
    <title>Document</title>
    <link rel="stylesheet" href="login_register_style.css">
    <link rel="stylesheet" href="navigation_bar_style.css">
</head>

<body>
    <?php
    $image_list = readAllStockItem();
    ?>

    <div class="collection">
        <div class="collection_column">

            <?php
            foreach ($image_list as $image) {
                $category_list = implode(",", $image['category']);
            ?>
                <a href="readStockItemByImageId.php?image_id=<?=$image['image_id']?>" class="collection_link">
                    <figure class="gallery_thumb">
                        <img src="<?= $image['gambar'] ?>" alt="<?= $image['judul'] ?>" class="collection_image">
                        <figcaption class="collection_caption"><?= $image['judul'] ?></figcaption>
                    </figure>
                </a>

                <a href="https://unsplash.com/@jeka_fe" target="_blank" class="gallery__link">
                    <figure class="gallery__thumb">
                        <img src="https://source.unsplash.com/_cvwXhGqG-o/300x300" alt="Portrait by Jessica Felicio" class="gallery__image">
                        <figcaption class="gallery__caption">Portrait by Jessica Felicio</figcaption>
                    </figure>
                </a>
            <?php
            }
            ?>
        </div>
    </div>

</body>

</html>