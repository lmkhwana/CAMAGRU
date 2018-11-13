<?php include 'config/connect.php';?>
<?php include 'views/header.php'?>

<?php
        session_start();

        if (isset($_POST['submit']))
        {
            if (!empty($_POST['email']))
            {

                $query = "SELECT * FROM users WHERE email = :email";
                $stmt = $db->prepare($query);
                $stmt->execute(array(':email' => $_POST['email']));
                
                if($row = $stmt->fetchAll(PDO::FETCH_ASSOC))
                {
                        // $_SESSION['username'] = $row[0]['username'];
                        // $_SESSION['id'] = $row[0]['id'];
                        // header('Location: index.php?session'.$_SESSION['id']);
                        $Name = "Camagru password recovery"; //senders name
                        $my_email = "no-reply@camagru.com"; //senders email
                        $recipient = $_POST['email'];
                        $subject = "Recover password";
                        $body = "Hello ".$row[0]['username'].", please click here to reset your password: http://127.0.0.1:8080/camagru/resetpassword.php?token=".$row[0]['token'];
                        $header = "From: ". $Name . " <" . $my_email . ">\r\n";

                         $result = mail($recipient, $subject, $body, $header);

                         if ($result)
                            $msg = "<p style='color: green;'>Please check your email for instructions.</p>";
                }
                else
                {
                    $msg = "<p style='color: red;'>Email doesn't exist in our database.</p>";
                }
            }
        }

?>
<section id="heading">
    <div class="container">
            <h1>Update password</h1>
    </div>
</section>
        
<form action="" method="post">
    <div class="container">
        <p>Please fill in this form update password.</p>
        <?php if (isset($msg)) echo($msg); ?>
        <hr>
                
        <label for="username"><b>Email</b></label>
        <input type="text" placeholder="Please enter the email address to recover the password to." name="email" required>
                
        <button name="submit" type="submit" class="registerbtn">Recover</button>
    </div>

    <div class="container signin">
        <p>Don't have an account? <a href="signup.php">Sign up</a>.</p>
    </div>
</form>
        
<?php include 'views/footer.php'?>
</html>