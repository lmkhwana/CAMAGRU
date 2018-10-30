<?php
    include 'config/database.php';
    session_start();
    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        try{
            $sql = "SELECT * FROM gallery WHERE id = :id";
            $st = $db->prepare($sql);
            $st->execute(array('id' => $id));
            $row = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex)
        {
            header('Location: index.php?msg'.$ex);
        }
       
        $likes = $row[0]['likes'];
        $insert = $likes + 1;

        try{
            $sql = "UPDATE gallery SET likes = :nu WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(':nu' => $insert, ':id' => $id));
        }
        catch(PDOException $ex)
        {
            header('Location: index.php?msg'.$ex);
        }
        echo $_SESSION['liked'] = 'liked';
        header('Location: index.php?like=liked');
    }

?>