<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "Army";
    $conn = "";

    try{
        $conn = mysqli_connect($db_server, 
                               $db_user, 
                               $db_pass, 
                               $db_name);
    }
    catch(mysqli_sql_exception){
        echo "ERROR could not connect <br>";
    }
    if($conn){
        echo "All systems are online <br>";
    }
?>