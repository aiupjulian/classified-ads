<?php
if(!isset($_SESSION['username'])) {
  header("location: index.php");
}
?>
<h2 class="register-title">Create Ad</h2>
<form action="" method="post" class="register">
  <label for="name">Name:</label>
  <input type="text" name="name" maxlength="15" required>
  <label for="description">Description:</label>
  <input type="text" name="description" maxlength="60" required>
  <label for="price">Price:</label>
  
  <button class="button">Register</button>
  <?php if (isset($error)) { ?>
    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
  <?php } ?>
</form>
