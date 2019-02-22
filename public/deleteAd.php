<?php
session_start();
if ($_GET['id'] && isset($_SESSION['username'])) {
  require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
  require_once(LIBRARY_PATH . "/databaseFunctions.php");
  $link;
  connect($link);

  $user_id = mysqli_real_escape_string($link, $_SESSION['id']);
  $ad_id = mysqli_real_escape_string($link, $_GET['id']);

  $query = "SELECT * FROM ad WHERE id='$ad_id'";
  $adResult = mysqli_query($link, $query);
  $ad = mysqli_fetch_array($adResult, MYSQLI_ASSOC);
  $count = mysqli_num_rows($adResult);

  if ($count == 1 && ($ad['userId'] == $user_id || $_SESSION['admin'])) {
    $query = "DELETE FROM ad WHERE id='$ad_id'";
    echo mysqli_query($link, $query);
    if (mysqli_query($link, $query)) {
      header("location: profile.php");
    } else {
      echo mysqli_error($link);
      header("location: index.php");
    }
  } else {
    echo mysqli_error($link);
    header("location: index.php");
  }
} else {
  header("location: index.php");
}
?>
