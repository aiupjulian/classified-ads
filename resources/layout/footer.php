<?php
require_once(LIBRARY_PATH . "/databaseFunctions.php");
$link;
connect($link);

$query = "SELECT user.email FROM user WHERE user.admin=1 LIMIT 1";
$adminResult = mysqli_query($link, $query);
$admin = mysqli_fetch_array($adminResult, MYSQLI_ASSOC);
?>
<div class="footer">
    <div class="footer-name">&#9400;2018 Classified Ads</div>
    <?php if (isset($admin['email'])) { ?>
      <div class="footer-contact">For any problems or doubts please contact: <?php echo $admin['email'];?></div>
    <?php
      mysqli_free_result($adminResult);
      close($link);
    } ?>
</div>
</body>
</html>
