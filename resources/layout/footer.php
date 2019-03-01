<?php
require_once(LIBRARY_PATH . "/databaseFunctions.php");
$link;
connect($link);

$query = "SELECT user.email FROM user WHERE user.admin=1 LIMIT 1";
$adminResult = mysqli_query($link, $query);
$admin = mysqli_fetch_array($adminResult, MYSQLI_ASSOC);
?>
<div class="footer">
    <div class="footer-sitemap">
      <h3>Mapa del sitio:</h3>
      <a href="index.php">Inicio</a>
      <a href="list.php">Listado</a>
      <?php if (isset($_SESSION['username'])) { ?>
        <a href="profile.php">Perfil</a>
        <a href="sell.php">Vender</a>
      <?php } else { ?>
        <a href="register.php">Registro</a>
        <a href="login.php">Login</a>
      <?php } ?>
    </div>
    <?php if (isset($admin['email'])) { ?>
      <div class="admin-contact">Ante cualquier duda o problema por favor contacte a: <?php echo $admin['email'];?></div>
    <?php
      mysqli_free_result($adminResult);
      close($link);
    } ?>
</div>
</body>
</html>
