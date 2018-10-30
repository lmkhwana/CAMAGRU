<?php include 'config/database.php'?>
<?php include 'views/header.php'?>
<?php session_start(); ?>


     <section id="heading">
        <div class="container">
                <h1>Gallery</h1>
        </div>
    </section>

    <section id="gallery">
    <div class="container">
    <?php 
        
        $stmt = $db->prepare('SELECT * FROM gallery
                               ORDER BY date_created DESC');
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $r)
        {
                    echo' <div class="box">
                                    <h4>Uploaded by: <a href="#">'.$r['user'].' </a></h4>
                                    <img src="'.$r['path'].'">
                                    <button><a href="like.php?id='.$r['id'].'">'.$r['likes'].' Like</a></button></form>
                                    <button><a href="comment.php?id='.$r['id'].'">Comment</a></button>
                                </div>';
        }
        ?>
        <?php

            if(isset($_POST['submit']))
            {
                header('Location: like.php?id='.$r['id']);
            }
        ?>
        
        </div>
        </section>
        
        
        
    <?php include 'views/footer.php';?>
</html>