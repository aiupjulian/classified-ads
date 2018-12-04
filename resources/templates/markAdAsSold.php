<?php
if(!isset($_SESSION['username'])) {
  header("location: profile.php");
}

?>
