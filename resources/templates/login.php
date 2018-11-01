<?php
if(isset($_SESSION['username'])) {
  header("location: welcome.php");
}
unset($error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once(LIBRARY_PATH . "/databaseFunctions.php");
  $link;
  connect($link);

  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = mysqli_real_escape_string($link, $_POST['password']);

  $query = "SELECT * FROM user WHERE username='$username'";
  $userResult = mysqli_query($link, $query);
  $user = mysqli_fetch_array($userResult, MYSQLI_ASSOC);
  $count = mysqli_num_rows($userResult);

  if ($count == 1 && password_verify($password, $user["password"])) {
    $_SESSION['username'] = $username;
    mysqli_free_result($userResult);
    close($link);
    header("location: welcome.php");
  } else {
    $error = "Username or password is invalid";
  }
}
?>
<h2 class="login-title">Login</h2>
<form action="" method="post" class="login">
  <label for="username">Username:</label>
  <input type="text" name="username" maxlength="15" required/>
  <label for="password">Password:</label>
  <input type="password" name="password" maxlength="30" required/>
  <button class="button">Submit</button>
  <?php if (isset($error)) { ?>
    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
  <?php } ?>
</form>
