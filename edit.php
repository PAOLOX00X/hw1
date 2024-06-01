<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit();
   }

    if(isset($_POST['submit'])){
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $old_password = test_input($_POST['old_password']);
    $new_password = test_input($_POST['new_password']);
    $new_password_confirm = test_input($_POST['new_password_confirm']);

    $id = $_SESSION['id'];
    $result = mysqli_query($con, "SELECT password FROM info WHERE id='$id'") or die("Error");
    $row = mysqli_fetch_assoc($result);
    $db_password = $row['password'];

    if(!preg_match("/^[a-zA-Z-' ]*$/", $username)){
        echo "<div class='message'>
                    <p>This username is not valid, space and letters only. Try another one, please!</p>
                </div> <br>";
        //echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    }   elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<div class='message'>
                    <p>This email is not valid. Try another one, please!</p>
                </div> <br>";
        //echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        } elseif(!password_verify($old_password, $db_password)){
        echo "<div class='message'>
                <p>Old password is not correct.</p>
                </div> <br>";
        //echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        } elseif($new_password != $new_password_confirm){
        echo "<div class='message'>
                    <p>Passwords do not match. Try again!</p>
                </div> <br>";
        //echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        } else{
        $password = password_hash($new_password, PASSWORD_DEFAULT); 
        $username = mysqli_real_escape_string($con, $username);
        $email = mysqli_real_escape_string($con, $email);

        $edit_query = mysqli_query($con, "UPDATE info SET username='$username', email='$email', password='$password' WHERE id='$id'") or die("Error occurred");
        
        echo $edit_query;
        
        if($edit_query){
            echo "<div class='message'>
                    <p>Profile Updated!</p>
                    </div> <br>";
            echo "<a href='home.php'><button class='btn'>Go Home</button></a>";
        }
        }
    } else {
    $id = $_SESSION['id'];
    $query = mysqli_query($con, "SELECT * FROM info WHERE id='$id'");

    if($result = mysqli_fetch_assoc($query)){
        $res_username = $result['username'];
        $res_email = $result['email'];
        $res_password = $result['password'];
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($res_username); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($res_email); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="new_password_confirm">New Password Confirm</label>
                    <input type="password" name="new_password_confirm" id="new_password_confirm" autocomplete="off" required>
                </div>
                
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update">
                </div>
            </form>
        </div>
      </div>
</body>
</html>