<?php
    include 'database.php';

    try {
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    $conn->exec($sql);
    $sql = "use camagru";
    $conn->exec($sql);
    $sql = "CREATE TABLE `users` (
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
    $conn->exec($sql);
    $sql = "CREATE TABLE `comments` (
        `id` int(11) NOT NULL,
        `post_id` int(11) NOT NULL,
        `comment` varchar(255) NOT NULL,
        `user` varchar(255) NOT NULL
      )";
    $conn->exec($sql);
    $sql = "CREATE TABLE `gallery` (
        `id` int(11) NOT NULL,
        `user` varchar(255) NOT NULL,
        `path` varchar(255) NOT NULL,
        `date_created` datetime NOT NULL
      )";
    $conn->exec($sql);
    echo "DB created successfully";
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
?>