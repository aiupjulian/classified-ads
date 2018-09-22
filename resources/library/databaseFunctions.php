<?php
require_once(realpath(dirname(__FILE__) . "/../config.php"));

function connect(&$link) {
    global $config;
    $link = mysqli_connect(
        $config["db"]["host"],
        $config["db"]["username"],
        $config["db"]["password"],
        $config["db"]["dbname"]
    );
    /* Check connection */
    if (mysqli_connect_errno()) {
        printf("Connection failed: %s\n", mysqli_connect_error());
        exit();
    }
}

function close(&$link) {
    mysqli_close($link);
}
?>
