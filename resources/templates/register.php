<?php
unset($error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once(LIBRARY_PATH . "/databaseFunctions.php");
  $link;
  connect($link);

  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = mysqli_real_escape_string($link, $_POST['password']);
  $hash = password_hash($password, PASSWORD_BCRYPT);

  $query = "SELECT * FROM user WHERE username='$username'";
  $userResult = mysqli_query($link, $query);

  $count = mysqli_num_rows($userResult);

  if ($count == 1) {
    $error = "Username has already been taken";
  } else {
    $query = "INSERT INTO user (username, password) VALUES ('$username', '$hash')";
    if (mysqli_query($link, $query)) {
      header("location: welcome.php");
    } else {
      echo $query;
      echo mysqli_error($link);
      $error = "Error while trying to create user";
    }
  }
}
?>
<h2 class="register-title">Register</h2>
<form action="" method="post" class="register">
  <label for="username">Username:</label>
  <input type="text" name="username" maxlength="32" required>
  <label for="password">Password:</label>
  <input type="password" name="password" maxlength="8" required>
  <button class="button">Register</button>
</form>
<?php if (isset($error)) { ?>
  <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
<?php } ?>
