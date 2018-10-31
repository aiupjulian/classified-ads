<?php
session_start();
unset($error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once(LIBRARY_PATH . "/databaseFunctions.php");
  $link;
  connect($link);

  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = mysqli_real_escape_string($link, $_POST['password']);

  $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $userResult = mysqli_query($link, $query);
  $user = mysqli_fetch_array($userResult, MYSQLI_ASSOC);
  $active = $user['active'];
  $count = mysqli_num_rows($userResult);

  if ($count == 1) {
     session_register("username");
     $_SESSION['username'] = $username;
     mysqli_free_result($userResult);
     close($link);

     header("location: index.php");
  } else {
     $error = "Username or password is invalid";
  }
}
?>
<h2 class="login-title">Login</h2>
<form action="" method="post" class="login">
  <label for="username">Username:</label>
  <input type="text" name="username" />
  <label for="password">Password:</label>
  <input type="password" name="password" />
  <button class="button">Submit</button>
  <?php if (isset($error)) { ?>
    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
  <?php } ?>
</form>
