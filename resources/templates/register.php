<?php
unset($error);
if(isset($_SESSION['username'])) {
  header("location: welcome.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once(LIBRARY_PATH . "/databaseFunctions.php");
  $link;
  connect($link);

  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = mysqli_real_escape_string($link, $_POST['password']);
  $name = mysqli_real_escape_string($link, $_POST['name']);
  $phone = mysqli_real_escape_string($link, $_POST['phone']);
  $email = mysqli_real_escape_string($link, $_POST['email']);
  $hash = password_hash($password, PASSWORD_BCRYPT);

  $query = "SELECT * FROM user WHERE username='$username'";
  $userResult = mysqli_query($link, $query);

  $count = mysqli_num_rows($userResult);

  if ($count == 1) {
    $error = "Username has already been taken";
  } else {
    $query = "INSERT INTO user (username, password, name, phone, email) VALUES ('$username', '$hash', '$name', '$phone', '$email')";
    if (mysqli_query($link, $query)) {
      $_SESSION['username'] = $username;
      $_SESSION['id'] = mysqli_insert_id($link);
      header("location: welcome.php");
    } else {
      $error = "Error while trying to create user";
    }
  }
  close($link);
}
?>
<h2 class="form-title">Register</h2>
<form action="" method="post" class="form">
  <label for="username">Username:</label>
  <input type="text" name="username" maxlength="15" required>
  <label for="password">Password:</label>
  <input type="password" name="password" maxlength="30" required>
  <label for="name">Name:</label>
  <input type="text" name="name" maxlength="30" required>
  <label for="phone">Phone:</label>
  <input type="tel" name="phone" maxlength="15" required>
  <label for="email">Email:</label>
  <input type="email" name="email" maxlength="20" required>
  <button class="button">Register</button>
  <?php if (isset($error)) { ?>
    <div class="error"><?php echo $error; ?></div>
  <?php } ?>
</form>
