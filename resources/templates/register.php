<style>
input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
 
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
<?php
unset($error);
if(isset($_SESSION['username'])) {
  header("location: profile.php");
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
  
  if ($username=='' || $password=='' || $name=='' || $phone=='' || $email=='') {
    $error = 'Por favor complete todos los campos requeridos.';
  }
  if (!isset($error)) {
    $query = "SELECT * FROM user WHERE username='$username'";
    $userResult = mysqli_query($link, $query);

    $count = mysqli_num_rows($userResult);

    if ($count == 1) {
      $error = "El usuario ya está en uso.";
    } else {
      $query = "INSERT INTO user (username, password, name, phone, email) VALUES ('$username', '$hash', '$name', '$phone', '$email')";
      if (mysqli_query($link, $query)) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = mysqli_insert_id($link);
        $_SESSION['email'] = $email;
        header("location: profile.php");
      } else {
        $error = "Hubo un error al intentar crear el usuario.";
      }
    }
    close($link);
  }
}
?>
<h2 class="form-title">Registro</h2>
<form action="" method="post" class="form">
  <label for="username">Usuario:<span class="required"> (*)</span></label>
  <input type="text" name="username" maxlength="15" required>
  <label for="password">Contraseña:<span class="required"> (*)</span></label>
  <input type="password" name="password" maxlength="30" required>
  <label for="name">Nombre:<span class="required"> (*)</span></label>
  <input type="text" name="name" maxlength="30" required>
  <label for="phone">Teléfono:<span class="required"> (*)</span></label>
  <input type="number" name="phone" maxlength="15" required>
  <label for="email">Email:<span class="required"> (*)</span></label>
  <input type="email" name="email" maxlength="40" required>
  <button class="button">Registrarse</button>
  <?php if (isset($error)) { ?>
    <div class="error"><?php echo $error; ?></div>
  <?php } ?>
</form>
