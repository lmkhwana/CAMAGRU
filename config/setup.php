<?php
    //include 'connect.php';
    $db = new PDO('mysql:host=localhost', 'root', '56658378');
    try {
        //Create the camagru database
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    $db->exec($sql);
   $sql = "use camagru";
   $db->exec($sql);
    //create the users table
    $sql = "CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL,
        `f_name` varchar(255) NOT NULL,
        `l_name` varchar(255) NOT NULL,
        `username` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        `token` varchar(255) NOT NULL,
        `passwordunsecure` varchar(255) NOT NULL,
        `is_confirmed` int(11) NOT NULL DEFAULT '0'
      )";
    $db->exec($sql);
    //create the comments table
    $sql = "CREATE TABLE IF NOT EXISTS `comments` (
        `id` int(11) NOT NULL,
        `post_id` int(11) NOT NULL,
        `comment` varchar(255) NOT NULL,
        `user` varchar(255) NOT NULL
      )";
    $db->exec($sql);
    //create the gallery table
    $sql = "CREATE TABLE IF NOT EXISTS `gallery` (
        `id` int(11) NOT NULL,
        `user` varchar(255) NOT NULL,
        `path` varchar(255) NOT NULL,
        `date_created` datetime NOT NULL
      )";
    $db->exec($sql);
    header('Location: ../index.php');
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
?>