<?php
session_start();
if ($_GET['id'] && isset($_SESSION['username'])) {
  require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
  require_once(LIBRARY_PATH . "/databaseFunctions.php");
  $link;
  connect($link);

  $user_id = mysqli_real_escape_string($link, $_SESSION['id']);
  $ad_id = mysqli_real_escape_string($link, $_GET['id']);

  $query = "SELECT * FROM ad WHERE id='$ad_id' AND user_id='$user_id'";
  $adResult = mysqli_query($link, $query);
  $count = mysqli_num_rows($adResult);
  $ad = mysqli_fetch_array($adResult, MYSQLI_ASSOC);

  if ($count == 1) {
    $query = "UPDATE ad SET sold=1 WHERE id='$ad_id'";
    if (mysqli_query($link, $query)) {
      header("location: profile.php");
    } else {
      header("location: index.php");
    }
  } else {
    header("location: index.php");
  }
} else {
  header("location: index.php");
}
?>
