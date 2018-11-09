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



        $per_page = 5;

        $sql = "SELECT * FROM gallery";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        //total number of pages available
        $number_pages = ceil($count/$per_page);

        //determite which page number the visitor is on
        if (!isset($_GET['page']))
        {
            $page = 1;
        }
        else
        {
            $page = $_GET['page'];
        }

        //results on each page (1 - 5) (6 - 10)
        $starting_number = ($page - 1) * $per_page;

        //query
        $sql = "SELECT * FROM gallery ORDER BY date_created DESC LIMIT " . $starting_number. ',' . $per_page;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll();
        foreach($row as $r)
        {
                    echo' <div class="box">
                                    <h4>Uploaded by: <a href="#">'.$r['user'].' </a></h4>
                                    <img src="'.$r['path'].'">
                                    <button onclick="like()" id="like"><a href="like.php?id='.$r['id'].'">'.$r['likes'].' Like</a></button></form>
                                    <button><a href="comment.php?id='.$r['id'].'">Comment</a></button>
                                </div>';
        }

        //display links for each page
        for ($page=1; $page <= $number_pages; $page++)
        {
            echo '<a href="index.php?page='. $page .'"> ' . $page . ' </a>';
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