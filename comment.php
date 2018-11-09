<?php
    include "config/database.php";
    session_start();

    $sql = "SELECT * FROM gallery WHERE id = :id";
    $st = $db->prepare($sql);
    $st->execute(array('id' => $_GET['id']));
    $row = $st->fetch();

    if (isset($_SESSION['id']) && isset($_SESSION['username']))
    {
        if(isset($_POST['submit']))
        {
            $comment = $_POST['comment'];
            
            $query = "INSERT INTO comments (post_id, comment, user) VALUES(:id, :comment, :user)";
            $stmt = $db->prepare($query);
            $stmt->execute(array(':id' => $_GET['id'], ':comment' => $comment, ':user' => $_SESSION['username']));


            $sq = "SELECT * FROM users WHERE username = :user";
            $s = $db->prepare($sq);
            $s->execute(array(':user' => $row['user']));
            $r = $s->fetch();

            $Name = "Camagru comment"; //senders name
            $my_email = "no-reply@camagru.com"; //senders email
            $recipient = $r['email'];
            $subject = "New comment";
            $headers .= "From: ". $Name . " <" . $my_email . ">\r\n";
            $body = "Hello , You have a new comment from ". $_SESSION['username']." : ". $comment. " view it here http://http://127.0.0.1:8080/camagru/comment.php?id=".$_GET['id'];
                            

            $result = mail($recipient, $subject, $body, $header);
        }
    }
    else
    {
        header('Location: login.php?msg=loginfirst');
    }
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="vewport" content="width=device-width" >
        <meta name="author" content="Luthando Mkhwanazi">
        <meta name="description" content="A photobooth website.">
        <title>Camaguru | Welcome</title>
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
        <?php include 'views/header.php';?>

         <section id="heading">
            <div class="container">
                 <h1>Comments</h1>
            </div>
        </section>
        
        <section id="photobooth">
            <div class="container">
                <article id="main-col" style="float: left; width: 55%; margin-top: 10px;">
                    <h1 class="title"> Image </h1>
                     <img src="<?php echo $row['path']?>" width="70%" />

                </article>
                <aside id="sidebar" style=" height:auto; float: right; width: 40%; margin-top: 10px;">
                    <h3>Comments</h3>
                    <div class="preview">
                    <?php

                        $sql = "SELECT * FROM comments WHERE post_id = :id";
                        $st = $db->prepare($sql);
                        $st->execute(array('id' => $_GET['id']));
                        $row = $st->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($row as $r)
                        {
                            echo 'User:  <a href="#">'.$r['user'].'</a> <p style="color: grey;"># '. $r['comment'].' </p>';
                        }
                    ?>
                    <form action="" method="post">

                        <input type="text" placeholder="Enter a comment" name="comment" required>  
                        <button name="submit" type="submit" class="registerbtn">Comment</button>

                    </form>
                    </div>
                </aside>
            </div>
        </section>
        <script src="scripts/webcam_script.js"></script>
        </body>
    <?php include 'views/footer.php'?>
</html>