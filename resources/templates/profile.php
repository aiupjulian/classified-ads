<?php
if (!isset($_SESSION['username'])) {
  header("location: login.php");
}
require_once(LIBRARY_PATH . "/databaseFunctions.php");
$link;
connect($link);

$user_id = mysqli_real_escape_string($link, $_SESSION['id']);

$query = "SELECT * FROM user WHERE user.id = '$user_id'";
// $query = "SELECT ad.* AS ad, user.name AS user_name"
//   . " FROM ad INNER JOIN user ON ad.user_id = user.id"
//   . " WHERE user.id = '$_SESSION['id'])'";
$userResult = mysqli_query($link, $query);
$user = mysqli_fetch_array($userResult, MYSQLI_ASSOC);

$query = "SELECT * FROM ad WHERE ad.user_id = '$user_id'";
$adsResult = mysqli_query($link, $query);
?>

<h2 class="form-title">User data:</h2>
<div class="form">
  <div>Name: <?php echo $user['name']; ?></div>
  <div>Phone: <?php echo $user['phone']; ?></div>
  <div>Email: <?php echo $user['email']; ?></div>
</div>

<h2 class="form-title">User ads:</h2>
<ul class="ads-container">
  <div class="ads-list">
  <?php
  while ($ad = mysqli_fetch_array($adsResult, MYSQLI_ASSOC)) {
  ?>
    <li>
      <a href="<?php echo "/ad.php?id=" . $ad['id'] ?>">
        <img src="<?php echo "images/uploaded/" . $ad['image']; ?>" />
        <div class="ad-container">
          <div class="ad-name"><?php echo $ad['name']; ?></div>
          <div class="ad-price">$<?php echo $ad['price']; ?></div>
          <div class="ad-date"><?php echo $ad['date']; ?></div>
          <div><?php echo $ad['sold'] ? 'Sold' : 'Not sold'; ?></div>
        </div>
      </a>
      <div class="actions">
        <a class="button">Edit</a>
        <a class="button">Delete</a>
        <a class="button">Mark as sold</a>
      </div>
    </li>
  <?php
  }
  close($link);
  ?>
  </div>
</ul>
