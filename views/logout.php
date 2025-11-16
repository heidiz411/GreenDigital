<?php
      $logout=$_GET['logout'] ?? null;
    if($logout == 'logout'){
        session_start();
        session_destroy();
        session_unset();
        setcookie("user_id",'',time() + -3600 ,"/");
        unset($_COOKIE['user_id']);
        header('location: ../index.php');
        exit;
    }
?>