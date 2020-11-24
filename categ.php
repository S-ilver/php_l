<?php 
require "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $config['title'] ?></title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>
<body>

  <div id="wrapper">

  <?php include "config/header.php"; ?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
          <div class="block">
              <a href="/articles.php?cat=1">Все записи</a>
              <h3><?php echo $art_cat['title']; ?>[Новейшее]</h3>
          <?php
                $red = $_GET['cat'];

                $articles = mysqli_query($connection,"SELECT * FROM `articles` WHERE `categorie_id`=$red ORDER BY `id` DESC LIMIT 10");
                
                 while($art = mysqli_fetch_assoc($articles)) {
                ?>


              <?php
                 $art_cat = false;
                    foreach($cats as $cat) {
                    if($cat['id'] == $art['categorie_id']) {
                        $art_cat = $cat;
                         break;
                    }
                    }
            ?>
              <div class="block__content">
                <div class="articles articles__horizontal">
                 <!-- вывод статей по категорий -->


                    <article class="article">
                    <div class="article__image" style="background-image: url(/static/image/<?php echo $art['image'] ?>)"></div>
                    <div class="article__info">
                      <a href="/article.php?id=<?php echo $art['id'] ?>"><?php echo $art['title'] ?></a>
                      <div class="article__info__meta">

                        <small>Категория: <a href="/articles.php?cat=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
                      </div>
                      <div class="article__info__preview"><?php echo mb_substr(strip_tags($art['text']),0,100,'utf-8') ?></div>
                    </div>
                  </article>
                        <?php
                    }

                  ?>

              <!-- вывод статей по категорий  -->


                </div>
              </div>
            </div>

            <!-- вывод статей по категорий -->
          </section>
          <?php include "config/sidebar.php"; ?>
        </div>
      </div>
    </div>

  <?php include "config/footer.php"; ?>

  </div>

</body>
</html>