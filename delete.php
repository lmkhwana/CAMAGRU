<?php
    session_start();
    include 'config/connect.php';

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        try{
            $sql = "DELETE FROM gallery WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(':id' => $id));
        }
        catch (PDOException $e)
        {
            echo ($e.getMessage());
        }
        
        header('Location: photobooth.php?res=deleted');
    }