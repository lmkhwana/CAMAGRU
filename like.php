<?php
    include 'config/connect.php';
    session_start();

    if (isset($_SESSION['id']) && isset($_SESSION['username']))
    {
            if (isset($_GET['id']))
            {
                $id = $_GET['id'];
            echo $id;
            try{
                $sql = "SELECT * FROM likes WHERE username = :user";
                $st = $db->prepare($sql);
                $st->execute(array('user' => $_SESSION['username']));

                if ($row = $st->fetch())
                {
                    $sql = "DELETE * FROM likes WHERE username = :user AND post = :post";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array(':user' => $_SESSION['username'], ':post' => $id));
                }
                else
                {
                    $sql = "INSERT INTO likes (username, post) VALUES (:user, :post)";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array(':user' => $_SESSION['username'], ':post' => $id));
                }
            }
            catch(PDOException $ex)
            {
                header('Location: index.php?msg'.$ex);
            }
            
            echo $_SESSION['liked'] = 'liked';
            header('Location: index.php?like=liked');
        
    }
}
else
    {
        header('Location: login.php?msg=loginfirst');
    }

?>