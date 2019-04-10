<?php
    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
    require_once(LIBRARY_PATH . "/templateFunctions.php");
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: login.php');
    }      
    renderLayoutWithContentFile("profile");
?>
