<?php
    require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
    require_once(LIBRARY_PATH . "/templateFunctions.php");

    $setInIndexDotPhp = "Hey! I was set in the index.php file.";

    // Must pass in variables (as an array) to use in template
    $variables = array(
        'setInIndexDotPhp' => $setInIndexDotPhp
    );

    renderLayoutWithContentFile("index", $variables);
?>
