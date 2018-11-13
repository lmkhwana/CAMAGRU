<?php session_start(); ?>
<!DOCTYPE html>
<html>  
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="vewport" content="width=device-width" >
        <meta name="author" content="Luthando Mkhwanazi">
        <meta name="description" content="A photobooth website.">
        <title>Camaguru</title>
        <link rel="stylesheet" href="styles/style.css">
        <script src="../scripts/webcam_script.js"></script>
    </head>
    <body>
        <header>
            <div class="container">
                <div id="branding">
                   <a href="index.php"> <h1><span class="highlight">Cama</span>gru</h1></a>
                </div>
                <nav>
                    <ul>
                        <li class="current"><a href="index.php">Home</a></li>
                        <?php 
                                if (!isset($_SESSION['id']))
                                {
                                    echo '<li><a href="signup.php">Signup</a></li>';
                                }
                                else
                                {
                                    echo '<li><a href="profile.php">Profile</a></li>';
                                    echo '<li><a href="photobooth.php">Photobooth</a></li>';
                                    echo '<li><a href="logout.php">Logout</a></li>';
                                }
                        ?>
                    </ul>
                </nav>
            </div>
        </header>