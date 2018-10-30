<?php
    //Create db variables
    $host = 'localhost';
    $dbname = 'camagru';
    $user = 'root';
    $password = '56658378';

    //Create a data source name
    $dsn = 'mysql:host='. $host .'; dbname='. $dbname;

    try
    {
        //New instance of the PDO class(creating a connection)
        $db = new PDO($dsn, $user, $password);

        //turn on the exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)
    {
        //Failed to connect
        echo "Connection failed". "\n" .$ex->getMessage();
    }
    
    
    