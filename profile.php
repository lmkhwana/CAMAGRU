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
                     $firstname = $_POST['f_name'];
                     $lastname = $_POST['l_name'];
                     $username = $_POST['username'];
                     $email = $_POST['email'];
                     $password = hash("whirlpool", $_POST['psw']);
                     $id = $_SESSION['id'];

                    //Update query

                    $query = "UPDATE    `users`   
                             SET        `f_name` = $firstname,
                                        `l_name` = $lastname,
                                        `username` = $username,
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
                    $firstname = $row[0]['f_name'];
                    $lastname = $row[0]['l_name'];
                    $username = $row[0]['username'];
                    $email = $row[0]['email'];
                }
?>

<form action="" method="post">
        <div class="container">
        <p>You can update your information.</p>
        <hr>
        <?php if(isset($msg)) echo $msg."<br>"; ?>
        <label for="Username"><b>First name</b></label>
        <input type="text" placeholder="Current First name : <?php echo $firstname; ?>" name="f_name" required>

        <label for="Username"><b>Last name</b></label>
        <input type="text" placeholder="Current First name : <?php echo $lastname; ?>" name="l_name" required>

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