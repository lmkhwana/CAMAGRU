<?php
include "config/database.php";
session_start();

$token = $_GET['token'];

try
{
    $sql = "UPDATE users SET is_confirmed = :nu WHERE token = :token";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':nu' => '1', ':token' => $token));
    header('Location: login.php?msg=confirmed');
}
catch(PDOException $ex)
{
    $msg = 'Error: '.$ex.getMessage();
}



?>