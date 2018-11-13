<?php include 'config/connect.php';?>
<?php include 'views/header.php';?>
<?php

    if(isset($_POST['submit']))
    {
        if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['psw']) && !empty($_POST['psw-repeat']))
        {
            if (strlen($_POST['psw']) > 6)
            {
                if(!ctype_lower($_POST['psw']))
                {
                        if ($_POST['psw'] === $_POST['psw-repeat'])
                        {
                            //set variables
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $passwordunsecure = $_POST['psw'];
                            $password = hash("whirlpool", $_POST['psw']);
                            $selected = $_POST['preference'];
                            if ($selected == "yes")
                                $option = 1;
                            else
                                $option = 0;

                            //create a token
                            $token = "qwertyuiopasdfghjklljanASDFGHJKLMNBVCXZ1236547789!()*";
                            $token = str_shuffle($token);
                            $token = substr($token, 0, 9);

                            //Insert query
                            $query = "INSERT INTO users (username, email, password, token,  preference) VALUES  (:username, :email, :password, :token, :preference)";

                            //Prepare our statement
                            $stmt = $db->prepare($query);

                            //Execute
                            $stmt->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':token' => $token,  ':preference' => $option));

                            //Mail variables
                            $Name = "Camagru verify"; //senders name
                            $my_email = "no-reply@camagru.com"; //senders email
                            $recipient = $email;
                            $subject = "Confirm email";
                            $headers .= "From: ". $Name . " <" . $my_email . ">\r\n";
                            $body = "Welcome to Camagru ".$username.", Please click on the link to verify:  http://localhost:8080/camagru/login.php?token=$token";
                            

                            $result = mail($recipient, $subject, $body, $header);

                            if ($result)
                                $err = $err = "<p style='color: green;'>Registration successfull, Please confirm your email to login</p>";
                        }
                        else
                            $err = "<p style='color: red;'>Passwords do not match</p>";
                    }
                }
                else
                    $err = "<p style='color: red;'>Password cannot be all lowercase </p>";
                
                }
            else
                $err = "<p style='color: red;'>Password has to be 6 or more values</p>";
            }
    

?>

<section id="heading">
    <div class="container">
            <h1>Signup</h1>
     </div>
</section>

<form action="" method="post">
        <div class="container">
        <p>Please fill in this form to create an account.</p>
        <hr>
        <?php if(isset($err)) echo $err."<br>"; ?>
        <label for="Username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
            
        <label for="email"><b>Email</b></label>
        <input style = "width: 100%; padding: 15px; margin: 5px 0 22px 0; display: inline-block; border: none; background: #f1f1f1;" type="email" class="email" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
        <hr>
        <label for="preference"><b>Notification preference</b></label> <br \>
        <p>Would you like to recieve Notifications when users comment on your pictures?</p>
        <input type="radio"  name="preference" value="Yes" required checked>Yes <br>
        <input type="radio"  name="preference" value="No" required>No<br>
        <hr>
        <button type="submit" name="submit" class="registerbtn">Register</button>
          </div>

          <div class="container signin">
            <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
</form>
        

    <?php include 'views/footer.php'?>
</html>