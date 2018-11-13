<?php
    include "database.php";

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
?>