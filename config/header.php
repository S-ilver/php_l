<header id="header">
      <div class="header__top">
        <div class="container">
          <div class="header__top__logo">
            <a href="admin/admin.php" target="blank"><?php echo $config['title'] ?></a>
          </div>
          <nav class="header__top__menu">
            <ul>
              <li><a href="/">Главная</a></li>
              <li><a href="/pages/about.php">Обо мне</a></li>
              <li><a href="<?php echo $config['vk']; ?>" target="blank">Я Вконтакте</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- вывод категорий -->
    <?php
    $category = mysqli_query($connection,"SELECT * FROM `articles_categories`");
    $cats = array();
    while ($cat = mysqli_fetch_assoc($category)) {
        $cats[] = $cat;
    }
    ?>
      <div class="header__bottom">
        <div class="container">
          <nav>
            <ul>
                <?php
                    foreach($cats as $cat) {
                        ?>
                            <li><a href="categ.php?cat=<?php echo $cat['id']; ?>"><?php echo $cat['title'] ?></a></li>
                        <?php
                    }
                ?>  
            </ul>
            <!-- ------------ вывод категорий -->
          </nav>
        </div>
      </div>
    </header>