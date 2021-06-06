<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="navigation_bar_style.css">
    <link rel="stylesheet" href="profilePage_style.css">
    <script src="profilePage.js" defer></script>
    <script src="http://code.jquery.com/jquery.js"></script>
</head>

<body>
    <?php

    require_once("profile_controller.php");
    require_once("stockItem_controller.php");
    require_once("websiteHeader_after.html");

    ?>

    <?php
    session_start();
    $user_id = $_SESSION['user_id'];

    if (empty($user_id)) {
        header("location: loginPage.php");
    }

    $readProfile = readProfile($user_id);
    ?>

    <div class="container">
        <div class="profile-header">

            <div class="profile-img">
                <img src="<?= $readProfile['profile_picture'] ?>" width="200px">
            </div>
            <div class="profile-nav">
                <p class="username"><?= $readProfile['user_id'] ?></p>
                <div class="other-info">
                    <p class="tipe-user"><?= $readProfile['tipe_user'] ?></p>
                </div>
            </div>
            <a href="uploadImagePage.php" class="upload-image-link">
                <div class="profile-option">
                    <!-- <div class="notification"> -->
                    <div class="upload-image">
                        Upload image&nbsp;
                        <img src="asset/plus.png" class="icon-plus">
                    </div>
                    <!-- <i class="fa-solid fa-bell"></i> -->
                    <!-- <span class="alert-message">1</span> -->
                    <!-- </div> -->
                </div>
            </a>

        </div>
        <div class="main-body">
            <div class="left">
                <div class="profile-side">
                    <div class="profile-info">
                        <p class="profile-header-text"><b>Nama</b></p>
                        <p class="profile-text"><?= $readProfile['nama'] ?></p>

                        <p class="profile-header-text"><b>Email</b></p>
                        <p class="profile-text"><?= $readProfile['email'] ?></p>

                        <p class="profile-header-text bio-header"><b>Bio</b></p>
                        <p class="profile-text bio">The purpose of our live is to be <b>HAPPY</b>!</p>
                    </div>
                </div>
            </div>

            <div class="right">
                <div class="nav">
                    <ul>
                        <li data-tab-target="#post" class="active">Posts</li>
                        <li data-tab-target="#review">Reviews</li>
                        <li data-tab-target="#setting">Settings</li>
                    </ul>
                </div>
                <div class="clearFloat"></div>
                <div class="tab-content">
                    <div id="post" data-tab-content class="active">
                        <?php
                        $image_list = readStockItemByUserId($user_id);
                        $listSize = count($image_list);
                        if ($listSize === 0) {
                        ?>
                            <h4>There is No Post for Now</h4>
                        <?php
                        } else {
                        ?>
                            <div class="item_list">
                                <?php
                                foreach ($image_list as $image) {
                                    $category_list = implode(", ", $image['category']);
                                ?>
                                    <div class="item_data">
                                        <div class="item_image"><img src="<?= $image['gambar'] ?>"></div>

                                        <div class="item_detail">
                                            <h4 class="item_title"><?= $image['judul'] ?>
                                                <hr />
                                            </h4>
                                            <div class="item_price">
                                                <h5 class="price_text">Price</h5>
                                                <label>$<?= $image['harga'] ?></label>
                                                <hr />
                                            </div>
                                            <div class="item_type">
                                                <h5 class="type_text">Image format</h5>
                                                <label><?= $image['type'] ?></label>
                                                <hr />
                                            </div>
                                            <div class="item_category">
                                                <h5 class="category_text">Categories</h5>
                                                <label><?= $category_list ?></label>
                                            </div>
                                        </div>

                                        <div class="item_option">
                                            <a href="collectionDetail.php?image_id=<?= $image['image_id'] ?>" class="item_view">
                                                <div class="view_text">View</div>
                                            </a>
                                            <a href="editImagePage.php?image_id=<?= $image['image_id'] ?>" class="item_edit">
                                                <div class="edit_text">Edit</div>
                                            </a>
                                            <a href="deleteImagePage.php?image_id=<?= $image['image_id'] ?>" class="item_delete">
                                                <div class="delete_text">Delete</div>
                                            </a>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            </div>
                    </div>

                    <div id="review" data-tab-content>
                        <h4>There is No Review for Now</h4>
                    </div>

                    <div id="setting" data-tab-content>
                        <div class="setting">
                            <h1 class="setting-header">User Settings</h1>
                            <table cellspacing=0 border="0" class="table-setting">
                                <tr>
                                    <td>
                                        <p>Edit Account Information</p>
                                    </td>
                                    <td><button class="next_button"><a href="editProfilePage.php">></a></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Delete Account</p>
                                    </td>
                                    <td><button onclick="deletedAlert()" class="next_button"><a href="deleteProfilePage.php">></a></button></td>
                                </tr>
                            </table>
                            <div class="warn">
                                <p><b>Warning: Account deletion is permanent and cannot be undone.<br>
                                        Once your account is deleted, you can no longer to access this site
                                        by the same account.</b></p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

    <script>
        function deletedAlert() {
            alert("Account successfully deleted!");
        }

        function logoutAlert() {
            alert("Log Out Successful!");
        }
    </script>

</body>

</html>