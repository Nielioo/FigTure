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
    <title>Collection</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
    <link rel="stylesheet" href="collection_style.css">
</head>

<body>
    <?php
    $image_list = readAllStockItem();
    ?>
    <div class="page">
        <div class="collection">
            <?php
            foreach ($image_list as $image) {
            ?>
                <div class="collection_item">
                    <a href="collectionDetail.php?image_id=<?= $image['image_id'] ?>" class="collection_link">
                        <figure class="collection_figure">
                            <img src="<?= $image['gambar'] ?>" alt="<?= $image['judul'] ?>" class="collection_image">
                            <figcaption class="collection_caption"><?= $image['judul'] ?></figcaption>
                        </figure>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>