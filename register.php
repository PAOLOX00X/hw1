<?php
    session_start();
    include("armyDB.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST,"surname", FILTER_SANITIZE_SPECIAL_CHARS); 
        $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS); 
        $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
        $ver_password = filter_input(INPUT_POST,"ver_password", FILTER_SANITIZE_SPECIAL_CHARS);
        if(empty($name) || empty($username) || empty($email) || empty($password)){
            if(empty($name)){
                echo "Name is missing<br>";
            }
            if(empty($surname)){
                echo "Surname is missing<br>";
            }
            if(empty($username)){
                echo "Username is missing<br>";
            }
            if(empty($email)){
                echo "Email is missing<br>";
            }
            if(empty($password)){
                echo "Password is missing<br>";
            }
            elseif($password != $ver_password){
                echo "Passwords aren't matching";
                }
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT); 
            $sql = "INSERT INTO register (username, password, name, surname, email) 
                    VALUES ('$username', '$hash', '$name', '$surname', '$email')";  
    
            $ris = mysqli_query($conn, $sql);
            echo $ris;
        }
    }
    mysqli_close($conn);

    header("Location: mhw3.html");
?>

<!DOCTYPE html>
<html>
<body>
    <form method = "post">
        <h2>You did the right thing son</h2>
        <span>Insert your american credentials</span><br>
        name:<br>
        <input type="text" name="name"><br>
        surname:<br>
        <input type="text" name="surname"><br>
        username:<br>
        <input type="text" name="username"><br>
        email:<br>
        <input type="text" name="email"><br>
        password:<br>
        <input type="password" name="password"><br>
        verify password:<br>
        <input type="password" name="ver_password"><br>
        <input type="submit" name="submit" value="register">
    </form>
</body>
</html>



