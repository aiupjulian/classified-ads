<?php
if(!isset($_SESSION['username'])) {
  header("location: index.php");
}
?>
<div>Welcome <?php echo $_SESSION['username'] ?>!</div>
