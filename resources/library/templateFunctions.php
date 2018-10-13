<?php
require_once(realpath(dirname(__FILE__) . "/../config.php"));

function renderLayoutWithContentFile($contentFile, $variables = array()) {
    $contentFileFullPath = TEMPLATES_PATH . "/" . $contentFile . ".php";
    $styleFileFullPath = TEMPLATES_PATH . "/" . $contentFile . ".css";

    // making sure passed in variables are in scope of the template
    // each key in the $variables array will become a variable
    if (count($variables) > 0) {
        foreach ($variables as $key => $value) {
            if (strlen($key) > 0) {
                ${$key} = $value;
            }
        }
    }

    require_once(LAYOUT_PATH . "/header.php");

    echo "<div class=\"container\">\n"
       . "\t<div class=\"content\">\n";

    if (file_exists($contentFileFullPath)) {
        if (file_exists($styleFileFullPath)) {
            echo "<style>\n";
            require_once($styleFileFullPath);
            echo "</style>\n";
        }
        require_once($contentFileFullPath);
    } else {
        require_once(TEMPLATES_PATH . "/error.php");
    }

    echo "\t</div>\n"
       . "</div>\n";

    require_once(LAYOUT_PATH . "/footer.php");
}
?>
