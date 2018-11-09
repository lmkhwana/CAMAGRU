<?php session_start(); ?>
<?php include 'config/database.php'?>
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

                    $query = "UPDATE    `users`   
                             SET        `username` = $username,
                                        `email` = : $email,
                                        `password` = $password, 
                            WHERE       `id` = : $id";
                   
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                    
                   // header('Location: profile.php?updated=updated');

                   
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

        <label for="Username"><b>Username</b></label>
        <input type="text" placeholder="Current Username : <?php echo $username; ?>" name="username" required>
            
        <label for="email"><b>Email</b></label>
        <input style = "width: 100%; padding: 15px; margin: 5px 0 22px 0; display: inline-block; border: none; background: #f1f1f1;" type="email" class="email" placeholder="Current email : <?php echo $email; ?>" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Change Password" name="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
        <hr>

        <button type="submit" name="submit" class="registerbtn">Update</button>
          </div>

          <div class="container signin">
            <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
</form>
        

    <?php include 'views/footer.php'?>
</html>