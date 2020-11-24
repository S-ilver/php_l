<?php 
require "../config/config.php";
?>
        <div class="block" id="comment-add-form">
           <h3>Добавить статей</h3>
           <div class="block__content">
             <form method="POST" action="/admin/admin.php" class="form">
             <?php
               if(isset($_POST['do_post'])) {
                echo mysqli_query($connection,"INSERT INTO `articles` (`title`,`image`,`text`,`categorie_id`) VALUES ('". $_POST['title']."','". $_POST['images']."','f". $_POST['texts']."','". $_POST['cat_id']."')");
                echo 'super';
               }
             ?>
               <div class="form__group">
                 <div class="row">
                   <div class="col-md-6">
                     <input type="text" class="form__contre="title" placeholder="title">
                   </div>ol" required="" nam
                   <div class="col-md-6">
                     <input type="file" class="form__control" required="" name="images" placeholder="image">
                   </div>
                   <div class="col-md-6">
                     <input type="text" class="form__control" required="" name="texts" placeholder="text">
                   </div>
                   <div class="col-md-6">
                     <input type="number" class="form__control" required="" name="cat_id" placeholder="cat_id">
                   </div>
                 </div>
               </div>

               <div class="form__group">
                 <input type="submit" class="form__control" name="do_post" value="Добавить комментарий">
               </div>
             </form>
           </div>
         </div>
