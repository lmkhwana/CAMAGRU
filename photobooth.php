<?php
    include "config/database.php";
    session_start();

    if (isset($_SESSION['id']) && isset($_SESSION['username']))
    {
        
        $target_dir = "files/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // if (isset($_POST['save']))
        // {
        //     $img = $_POST['data'];
        //     $img = str_replace('data:image/png;base64,', '', $img);
        //     // $data = base64_decode($img);  
        //     // $file = $target_dir . uniqid() . '.png';
        //     // $success = file_put_contents($file, $data);
        //     // print $success ? $file : 'Unable to save the file.';  
        //     echo $img;
        // }

        if (isset($_POST['submit']))
        {
            $user = $_SESSION['username'];
            $date = date("Y-m-d H:i:s");
            if (file_exists($target_file))
                 $msg = "Sorry, file already exists.";
            else
            {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                    $msg = "Image successfully uploaded";
                else
                    $msg = "There was an error trying to upload your file";
                
                    try{
                        $stmt = $db->prepare('INSERT INTO `gallery` (`user`, `path`, `date_created`) VALUES (:user, :path, :date)');
                        $stmt->bindparam(':user', $user);
                        $stmt->bindparam(':path', $target_file);
                        $stmt->bindparam(':date', $date);
                        //$stmt->bindparam(':image', $image);
                        if($stmt->execute())
                        {
                            $msg = "File Upload Successfully........";
                            header("refresh:3;photobooth.php");
                        }
                        else
                            echo "dsa";
                    }
                catch(PDOException $e)
                {
                    echo "Error: ".$e.getMessage();
                }
            }
            
        }
    }
    else
        header('location: login.php?msg=loginfirst');
?>
<!DOCTYPE html>
<html>
        <?php include 'views/header.php';?>

         <section id="heading">
            <div class="container">
                 <h1>Photobooth</h1>
            </div>
        </section>
        
        <section id="photobooth">
            <div class="container">
                <hr>
               
                <article id="main-col" style="float: left; width: 55%; margin-top: 10px;">
                    <h1 class="title"> Snap a shot! </h1>
                    <video id="vidDisplay" width="100%" autoplay="true">
                        No Video support for your browser
                    </video>
                    <button href="#" onclick="save()" class="registerbtn" id="registerbtn">Capture!</button>

                    <h3 style="text-align: center;"> Or Upload </h3>
                    <hr>
                    <h3 style="text-align: center; color:red;"> <?php  if(isset($msg)) echo $msg; ?></h3>
                    <form action="photobooth.php" method="post" enctype="multipart/form-data">
                        File:
                        <input type="file" name="image">
                        <input type="submit" name="submit" class="registerbtn" style="margin-top: 10px;">
                    </form>

                </article>
                    <aside id="sidebar" style=" height:auto; float: right; width: 40%; margin-top: 10px;">
                        <h3>Preview</h3>
                        
                        <canvas id="boxi" width="300px" height="300px"></canvas>
                        <form method="post">
                        

                        <input type="text" name="data" id="data" value="" style="display:none;"/>
                        <input type="submit" name="save" class="registerbtn"  style="margin-top: 10px;">
                        </form>
                        
                        
  
                </aside>
            </div>
            <section id="gallery">
            <div class="container">
                <h2 style="text-align: center;">Your images</h2>
                <?php 
                
                    $query = "SELECT * FROM gallery WHERE user = :user";
                    $stmt = $db->prepare($query);
                    $stmt->execute(array(':user' => $_SESSION['username']));
                    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $r)
                    {
                        //print_r($row);
                         echo' <div class="box">
                                <img src="'.$r['path'].'"/>
                                <a href="delete.php?id='.$r['id'].'">Delete</a>
                                </div>';
   
                    }
                    
                
                ?>
            </div>
            </section>
        </section>
        <script src="scripts/webcam_script.js"></script>
        </body>
    <?php include 'views/footer.php'?>
</html>