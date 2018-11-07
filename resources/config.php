<?php
/*
    paths — Commonly used paths to various resources for your site.
        log files
        upload directories
        resources
    urls — Storing urls can be really handy when referencing remote resources throughout your site.
    emails — Store debugging or admin emails to use when handling errors or in contact forms.
*/
$config = array(
  "db" => array(
    "dbname" => "classified_ads",
    "username" => "root",
    "password" => "root",
    "host" => "localhost"
  ),
  "urls" => array(
    "baseUrl" => "http://classified-ads.test"
  ),
  "paths" => array(
    // "resources" => "/path/to/resources",
    "images" => array(
      "uploads" => realpath(dirname(__FILE__) . "/images"),
    )
  )
);

/*
    Creating constants for heavily used paths.
    ex. require_once(LIBRARY_PATH . "Paginator.php")
*/
defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));

defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

defined("LAYOUT_PATH")
    or define("LAYOUT_PATH", realpath(dirname(__FILE__) . '/layout'));

/*
    Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);

?>
