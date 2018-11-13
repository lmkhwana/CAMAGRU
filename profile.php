<?php session_start(); ?>
<?php include 'config/connect.php';?>
<?php include 'views/header.php';?>

<section id="heading">
    <div class="container">
            <h1>Profile</h1>
     </div>
</section>

<?php

        if(isset($_POST['submit']))
        {
            if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['psw']) && !empty($_POST['psw-repeat']))
            {
                 if ($_POST['psw'] === $_POST['psw-repeat'])
                {
                    //set variables
                     $username = $_POST['username'];
                     $email = $_POST['email'];
                     $password = hash("whirlpool", $_POST['psw']);
                     $id = $_SESSION['id'];

                    //Update query

                    $query = "UPDATE `users` SET `username`=?,`email`=?,`password`=? WHERE `id`=?";
                    $stmt = $db->prepare($query);
                    $stmt->execute([$username, $email, $password, $id]);
                    
                   header('Location: profile.php?updated=updated');

                   
                }
            }
        }
        

?>

<?php
                

                $query = "SELECT * FROM users WHERE username = :username";
                $stmt = $db->prepare($query);
                $stmt->execute(array(':username' => $_SESSION['username']));

                if ($row = $stmt->fetchAll(PDO::FETCH_ASSOC))
                {
                    $username = $row[0]['username'];
                    $email = $row[0]['email'];
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
        <input type="radio"  name="preference" value="Yes" required checked>Yes <br>
        <input type="radio"  name="preference" value="No" required>No<br>
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