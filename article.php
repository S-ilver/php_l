<?php 
require "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Блог IT_Минималиста!</title>

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
  <?php 
  $article = mysqli_query($connection,"SELECT * FROM `articles` WHERE `id` =".(int) $_GET['id']);

  if(mysqli_num_rows($article) <= 0) {
    ?>
    <div id="content">
    <div class="container">
      <div class="row">
        <section class="content__left col-md-8">
          <div class="block">

            <h3>Ne nayden</h3>
            <div class="block__content">
              <img src="/media/images/post-image.jpg">

              <div class="full-text">
                vamy zaprashyvaemy zapros ne nayden
                </div>
            </div>
          </div>
        </section>
    <?php
  }else {
    $art = mysqli_fetch_assoc($article);
    mysqli_query($connection,"UPDATE `articles` SET `views` = `views` + 1 WHERE `id` = " . (int) $art['id']);
    ?>
    
        <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <h5><?php echo $art['views'] ?> просмотром</h5>
              <h3><?php echo $art['title'] ?></h3>
              <div class="block__content">
                <img src="/static/image/<?php echo $art['image'] ?>">
                <div class="full-text">
                <?php echo $art['text'] ?>
                  </div>
              </div>
            </div>
        
                 <!-- вывод статей commentary-->    
            <div class="block">
            <a href="#comment-add-form">Добавить свой</a>
              <h3>Комментарии</h3>
              <div class="block__content">
                <div class="articles articles__vertical">

                 <?php
                  $comments = mysqli_query($connection,"SELECT * FROM `comments` WHERE `articles_id` = " . (int) $art['id'] . " ORDER BY `id` DESC");
                    if(mysqli_num_rows($comments) == 0) {
                      echo 'ne nayden';
                    }
                    while($comment = mysqli_fetch_assoc($comments)) {
                        ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(/static/image/<?php echo $comment['image'] ?>)"></div>
                      <div class="article__info">
                        <a href="/article.php?cat=<?php echo $comment['articles_id'] ?>"><?php echo $comment['nickname'] ?></a>
                        <div class="article__info__meta">

                        </div>
                        <div class="article__info__preview"><?php echo$comment['text'] ?></div>
                      </div>
                  </article>
                        <?php
                    }

                  ?>

                <!-- вывод статей commentary-->

                </div>
              </div>
            </div>
            <div class="block" id="comment-add-form">
              <h3>Добавить комментарий</h3>
              <div class="block__content">
                <form method="POST" action="/article.php?id=<?php echo $art['id']?>#comment-add-form" class="form">
                <?php
                  if(isset($_POST['do_post'])) {
					  $errors = array();
					if($_POST['names'] == '') {
						$errors[] = 'vvedie name';
					}
					if($_POST['nickname'] == '') {
						$errors[] = 'vvedie nickname';
					}
					if($_POST['email'] == '') {
						$errors[] = 'vvedie email';
					}
					if($_POST['texts'] == '') {
						$errors[] = 'vvedie text';
					}
					if(empty($errors)) {
						echo mysqli_query($connection,"INSERT INTO `comments` (`author`,`nickname`,`email`,`text`,`articles_id`) VALUES ('". $_POST['names']."','". $_POST['nickname']."','f". $_POST['email']."','". $_POST['texts']."','". $art['id']."')");
						echo 'super';
					}else{
						echo $errors[0];
					}
				  }
                ?>
                  <div class="form__group">
                    <div class="row">
                      <div class="col-md-6">
                        <input type="text" class="form__control" required="" name="names" placeholder="Имя">
                      </div>
                      <div class="col-md-6">
                        <input type="text" class="form__control" required="" name="nickname" placeholder="Никнейм">
                      </div>
                      <div class="col-md-6">
                        <input type="email" class="form__control" required="" name="email" placeholder="email">
                      </div>
                    </div>
                  </div>
                  <div class="form__group">
                    <textarea name="texts" required="" class="form__control" placeholder="Текст комментария ..."></textarea>
                  </div>
                  <div class="form__group">
                    <input type="submit" class="form__control" name="do_post" value="Добавить комментарий">
                  </div>
                </form>
              </div>
            </div>
          </section>

    <?php
  }
  ?>



<?php include "config/sidebar.php"; ?>
        </div>
      </div>
    </div>

    <?php include "config/footer.php"; ?>

  </div>

</body>
</html>