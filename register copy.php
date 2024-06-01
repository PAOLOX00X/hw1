<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
         include("php/config.php");
         if(isset($_POST['submit'])){

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $username = test_input($_POST['username']);
            $email = test_input($_POST['email']);
            $password = test_input($_POST['password']);
            $password_confirm = test_input($_POST['password_confirm']);
            
            //verifying the unique username and email             
            $verify_unique_username = mysqli_query($con,"SELECT username FROM info 
                                                    WHERE username='$username'");
            
            $verify_unique_email = mysqli_query($con,"SELECT email FROM info 
                                                    WHERE email='$email'");
         
         
         if(!preg_match("/^[a-zA-Z0-9_]{1,15}$/",$username)){
            echo "<div class='message'>
                      <p>This username is not valid, space and letters only, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         

         //mysql_num_rows ritorna il numero di righe che rispettano la condizione data
         elseif(mysqli_num_rows($verify_unique_username) !=0 ){
            echo "<div class='message'>
                      <p>This username is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }

         
         elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<div class='message'>
                      <p>This email is not valid, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         

         elseif(mysqli_num_rows($verify_unique_email) !=0 ){
            echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }

         elseif(strlen($password) <8 ){
            echo "<div class='message'>
                      <p>Passwords long not enough!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         elseif($password != $password_confirm){
            echo "<div class='message'>
                      <p>Passwords don't match, Try again!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{
            $password = password_hash($password, PASSWORD_DEFAULT); 

            mysqli_query($con," INSERT INTO info(username,email,password) 
                                VALUES('$username','$email','$password')") 
                        or die("Error Occured");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn'>Login Now</button>";
         
         }
         mysqli_close($con);

         }else{
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="on" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="on" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                
                <div class="field input">
                    <label for="password_confirm">Password confirm</label>
                    <input type="password" name="password_confirm" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>