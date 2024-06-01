<?php
    require_once 'armyDB.php';
    session_start();

    function control() {
        if(isset($_SESSION['_agora_user_id'])) {
            return $_SESSION['_agora_user_id'];
        } else 
            return 0;
    }
?>