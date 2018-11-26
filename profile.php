<?php session_start(); ?>
<?php include 'config/connect.php';?>
<?php include 'views/header.php';?>

<section id="heading">
    <div class="container">
            <h1>Profile</h1>
     </div>
</section>
<?php 

// $query = "SELECT * FROM users WHERE username =?";
// $stmt = $db->prepare($query);
// $stmt->execute([$_SESSION['username']]);

// if ($row = $stmt->fetch())
// {
//     $username = $row['username'];
//     $email = $row['email'];
// }


?>

<?php


 
        if(isset($_POST['submit']))
        {

            if (!empty($_POST['username']) && !empty($_POST['email']))
            {


                    //set variables
                     $usernamee = $_POST['username'];
                     $emaill = $_POST['email'];
                     $id = $_SESSION['id'];
                     $selected = $_POST['preference'];
                            if ($selected == "yes")
                                $option = 1;
                            else
                                $option = 0;

                    //Update query
                    try{
                        $stmt = $db->prepare("UPDATE users SET username=?,email=?,preference=? WHERE id=?");
                        $stmt->execute([$usernamee, $emaill, $option, $id]);
                        header('Location: profile.php');

                    }
                    catch(PDOException $e)
                    {
                        echo $e.getMessage();
                    }
                    
                   
        
            }
        }

        $query = "SELECT * FROM users WHERE username =?";
$stmt = $db->prepare($query);
$stmt->execute([$_SESSION['username']]);

if ($row = $stmt->fetch())
{
    $username = $row['username'];
    $email = $row['email'];
}

        

?>



<form action="" method="post">
        <div class="container">
        <p>You can update your information.</p>
        <hr>

        <?php if(isset($msg)) echo $msg."<br>"; ?>

        <label for="Username"><b>Username</b>: <?php echo $username; ?></label>
        <input type="text" placeholder="Update Username" name="username" required>
            
        <label for="email"><b>Email</b>: <?php echo $email; ?></label>
        <input style = "width: 100%; padding: 15px; margin: 5px 0 22px 0; display: inline-block; border: none; background: #f1f1f1;" type="email" class="email" placeholder="Update email" name="email" required>

        <label for="preference"><b>Update notification preference</b></label> <br \>
        <p>Would you like to recieve Notifications when users comment on your pictures?</p>
        <input type="radio"  name="preference" value="yes" required checked>Yes <br>
        <input type="radio"  name="preference" value="no" required>No<br>
        <hr>
        <div class="container signin">
            <p>Or <a href="forgot.php">Change password</a>.</p>
        </div>

        <button type="submit" name="submit" class="registerbtn">Update</button>
          </div>

          <div class="container signin">
            <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
</form>
        

    <?php include 'views/footer.php'?>
</html>