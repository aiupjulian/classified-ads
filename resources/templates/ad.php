<?php
require_once(realpath(dirname(__FILE__) . "/../config.php"));
global $config;
require_once(LIBRARY_PATH . "/databaseFunctions.php");
$link;
connect($link);

$ad_id = mysqli_real_escape_string($link, $_GET['id']);

$query = "SELECT ad.*, user.name AS user_name FROM ad INNER JOIN user ON ad.user_id = user.id WHERE ad.id='$ad_id'";
$adResult = mysqli_query($link, $query);
$ad = mysqli_fetch_array($adResult, MYSQLI_ASSOC);
$count = mysqli_num_rows($adResult);

if ($count == 1) {
  $name = $ad['name'];
  $description = $ad['description'];
  $price = $ad['price'];
  $date = $ad['date'];
  $user_name = $ad['user_name'];
  $image = $ad['image'];
  $sold = $ad['sold'];
  mysqli_free_result($adResult);
  close($link);
} else {
  header("location: error.php");
}
?>
<h2 class="ad-title"><?php echo $name; ?></h2>
<div class="ad-container">
  <div>
    <div>Description: <?php echo $description; ?></div>
    <div>Price: <?php echo $price; ?></div>
    <div>Date: <?php echo $date; ?></div>
    <div>User name: <?php echo $user_name; ?></div>
    <div>Sold: <?php echo $sold; ?></div>
  </div>
  <div>
    <img src="<?php echo "images/uploaded/" . $image; ?>" />
  </div>
</div>
