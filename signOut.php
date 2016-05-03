<?php
    session_start();
    $_SESSION['signIn'] = false;
    header('location: index.php');
?>
