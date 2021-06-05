<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="navigation_bar_style.css" />
  <link rel="stylesheet" href="homePage_style.css" />
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

  if (isset($_GET['submit'])) {
    if ($_GET['title']) {
      $title = $_GET['title'];
      header("location: collectionTitle.php?title=$title");
    }
  }

  ?>

  <div class="container">
    <div class="first">
      <h1 class="header-text">Get The Best Images from The Best Creators</h1>
      <div>
        <form class="search-form" method="GET">
          <input type="search" name="title" value="" placeholder="Search" class="search-input" />
          <button type="submit" name="submit" class="search-button">
            <svg class="submit-button">
              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search"></use>
            </svg>
          </button>
        </form>

        <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
          <symbol id="search" viewBox="0 0 32 32">
            <path d="M 19.5 3 C 14.26514 3 10 7.2651394 10 12.5 C 10 14.749977 10.810825 16.807458 12.125 18.4375 L 3.28125 27.28125 L 4.71875 28.71875 L 13.5625 19.875 C 15.192542 21.189175 17.250023 22 19.5 22 C 24.73486 22 29 17.73486 29 12.5 C 29 7.2651394 24.73486 3 19.5 3 z M 19.5 5 C 23.65398 5 27 8.3460198 27 12.5 C 27 16.65398 23.65398 20 19.5 20 C 15.34602 20 12 16.65398 12 12.5 C 12 8.3460198 15.34602 5 19.5 5 z" />
          </symbol>
        </svg>
      </div>

      <div class="holder">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
      </div>

    </div>

    <!-- Links -->
    <section class="links">
      <div class="links-inner">
        <?php
        $category_available_list = getCategoryList();
        $category = $category_available_list;

        $list_count = 0;
        $category_count = 0;
        for ($i = 0; $i < 5; $i++) {
        ?>
          <ul>
            <?php
            for ($j = 0; $j < 5; $j++) {
            ?>
              <li><a href="collectionCategory.php?category=<?= $category[$list_count] ?>"><?= $category[$list_count] ?></a></li>
            <?php
              $list_count++;
            }
            ?>
          </ul>
        <?php
        }
        ?>
      </div>
    </section>
  </div>
  <footer>
    <h5>
       © 2021 Figture. All rights reserved
    </h5>
  </footer>
</body>

</html>