<?php 
   session_start();

   include("php/config.php");
              if(isset($_POST['submit'])){
                $username = mysqli_real_escape_string($con,$_POST['username']);
                $password = mysqli_real_escape_string($con,$_POST['password']);

                $result = mysqli_query($con,"SELECT * FROM info WHERE username='$username'") or 
                          die("Error");
                $row = mysqli_fetch_assoc($result);

                if(empty($row)){
                    echo "<div class='message'>
                            <p>No such user exist or Wrong username</p>
                          </div> <br>";
                   echo "<a href='login.php'><button class='btn'>Go Back</button>";
                }
                elseif(!password_verify($password,$row['password'])){
                    echo "<div class='message'>
                            <p>Wrong password</p>
                          </div> <br>";
                    echo "<a href='login.php'><button class='btn'>Go Back</button>";
                }
                else
                {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['id'] = $row['id'];
                }
                if(isset($_SESSION['username'])){
                    header("Location: home.php");
                }
                mysqli_close($con);
              }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
             
              
            
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="on" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>