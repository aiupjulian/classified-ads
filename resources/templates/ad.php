<?php
require_once(realpath(dirname(__FILE__) . "/../config.php"));
global $config;
require_once(LIBRARY_PATH . "/databaseFunctions.php");
$link;
connect($link);

$ad_id = mysqli_real_escape_string($link, $_GET['id']);

$query = "SELECT ad.*, user.name AS user_name, city.name AS city_name, state.name AS state_name, subcategory.name AS subcategory_name, category.name AS category_name"
  . " FROM ad INNER JOIN user ON ad.user_id = user.id"
  . " INNER JOIN city ON ad.city_id = city.id"
  . " INNER JOIN state ON city.state_id = state.id"
  . " INNER JOIN subcategory ON ad.subcategory_id = subcategory.id"
  . " INNER JOIN category ON subcategory.category_id = category.id WHERE ad.id='$ad_id'";
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
  $state = $ad['state_name'];
  $city = $ad['city_name'];
  $category = $ad['category_name'];
  $subcategory = $ad['subcategory_name'];
  mysqli_free_result($adResult);
  close($link);
} else {
  header("location: error.php");
}
?>
<h2 class="ad-title"><?php echo $name; ?></h2>
<div class="ad-container">
  <div class="ad-details">
    <div><b>Description:</b> <?php echo $description; ?></div>
    <div><b>Price:</b> $<?php echo $price; ?></div>
    <div><b>Date posted:</b> <?php echo $date; ?></div>
    <div><b>Username:</b> <?php echo $user_name; ?></div>
    <div><b>Sold:</b> <?php echo $sold; ?></div>
    <div><b>State:</b> <?php echo $state; ?></div>
    <div><b>City:</b> <?php echo $city; ?></div>
    <div><b>Category:</b> <?php echo $category; ?></div>
    <div><b>Subcategory:</b> <?php echo $subcategory; ?></div>
  </div>
  <div class="ad-image">
    <img src="<?php echo "images/uploaded/" . $image; ?>" />
  </div>
</div>
