<?php include 'config/connect.php';?>
<?php include 'views/header.php'?>

<?php
        session_start();

        $token = $_GET['token'];

        //echo $token;

        $quer = "SELECT * FROM users WHERE token = :token";
        $stm = $db->prepare($quer);
        $stm->execute(array(':token' => $token));

        if (isset($_POST['submit']))
        {
            if (!empty($_POST['pwd']) && !empty($_POST['pwd-conf']))
            {
                if ($_POST['pwd'] == $_POST['pwd-conf'])
                {
                    if (strlen($_POST['pwd']) >= 7)
                    {
                        if(!ctype_lower($_POST['pwd']))
                        {
                            $password = hash("whirlpool", $_POST['pwd']);
        
                            $sql = "UPDATE users SET `password`=?";
                            $stmt= $db->prepare($sql);
                            $stmt->execute([$password]);
                            $msg = "<p style='color: green;'>Password changed, you may now login using the new password!</p>";
                        }
                        else
                            $msg = "<p style='color: red;'>Password cannot be all lower case!</p>";
                    }
                    else
                        $msg = "<p style='color: red;'>Password length must be greater than 6!</p>";
                    
                }
                else
                    $msg = "<p style='color: red;'>Passwords have to match!</p>";
              
            }
            else
             $msg = "<p style='color: red;'>Can not be empty</p>";
        }

?>
<section id="heading">
    <div class="container">
            <h1>Reset password</h1>
    </div>
</section>
        
<form action="" method="post">
    <div class="container">
        <p>Please fill in this form reset password.</p>
        <?php if (isset($msg)) echo($msg); ?>
        <hr>
                
        <label for="psw"><b>New Password</b></label>
        <input type="password" placeholder="Enter a password" name="pwd" required>
                
        <label for="psw"><b>Confirm Password</b></label>
        <input type="password" placeholder="Enter confirm your Password" name="pwd-conf" required>

        <hr>
        <button name="submit" type="submit" class="registerbtn">submit</button>
    </div>

</form>
        
<?php include 'views/footer.php'?>
</html>