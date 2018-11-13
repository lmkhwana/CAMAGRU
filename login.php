<?php include 'config/connect.php';?>
<?php include 'views/header.php'?>

<?php
        session_start();

        if (isset($_GET['token']))
        {
           header('Location: confirm.php?token='.$_GET['token']);
        }

        if (isset($_GET['msg']) && $_GET['msg'] == "confirmed")
            $msg = "<p style='color: green;'>Congrats! You can now login.</p>";

        if (isset($_POST['submit']))
        {
            if (!empty($_POST['username']) && !empty($_POST['psw']))
            {
                $username = $_POST['username'];
                $password = hash("whirlpool", $_POST['psw']);

                $query = "SELECT * FROM users WHERE username = :username AND password = :password";
                $stmt = $db->prepare($query);
                $stmt->execute(array(':username' => $username, ':password' => $password));
                
                if($row = $stmt->fetchAll(PDO::FETCH_ASSOC))
                {
                    if ($row[0]['is_confirmed'] == 1)
                    {
                        $_SESSION['username'] = $row[0]['username'];
                        $_SESSION['id'] = $row[0]['id'];
                        header('Location: photobooth.php?username='.$_SESSION['username']);
                    }
                    else
                        $msg = "<p style='color: green;'>Please go and verify your email address.</p>";
                }
                
                
                else
                {
                    $msg = "<p style='color: red;'>Incorrect Username/password</p>";
                }
            }
        }

?>
<section id="heading">
    <div class="container">
            <h1>Login</h1>
    </div>
</section>
        
<form action="" method="post">
    <div class="container">
        <p>Please fill in this form login.</p>
        <?php if (isset($msg)) echo($msg); ?>
        <hr>
                
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
                
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <hr>
        <p><a href="forgot.php">Forgot password</a>.</p>
        <button name="submit" type="submit" class="registerbtn">Login</button>
    </div>

    <div class="container signin">
        <p>Don't have an account? <a href="signup.php">Sign up</a>.</p>
    </div>
</form>
        
<?php include 'views/footer.php'?>
</html>