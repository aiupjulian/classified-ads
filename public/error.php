<?php
    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
    require_once(LIBRARY_PATH . "/templateFunctions.php");

    $setInErrorDotPhp = "Hey! I was set in the error.php file.";

    // Must pass in variables (as an array) to use in template
    $variables = array(
        'setInErrorDotPhp' => $setInErrorDotPhp
    );

    renderLayoutWithContentFile("error", $variables);
?>
