<?php
require_once(LIBRARY_PATH . "/databaseFunctions.php");
$link;
connect($link);

$conditions = array();
if (isset($_GET["name"])) {
  $conditions[] = "ad.name LIKE '%" . mysqli_real_escape_string($link, $_GET["name"]) . "%'";
}
if (isset($_GET["subcategory"])) {
  $conditions[] = "subcategory_id=" . mysqli_real_escape_string($link, $_GET["subcategory"]);
}
if (isset($_GET["city"])) {
  $conditions[] = "city_id=" . mysqli_real_escape_string($link, $_GET["city"]);
}
if (isset($_GET["price1"]) && isset($_GET["price2"])) {
  $conditions[] = "price BETWEEN " . mysqli_real_escape_string($link, $_GET["price1"]) . " AND " . mysqli_real_escape_string($link, $_GET["price2"]);
}

$query = "SELECT ad.*, user.name AS user_name FROM ad INNER JOIN user ON ad.user_id=user.id";
if (count($conditions) > 0) {
  $query .= " WHERE " . implode(" AND ", $conditions);
}
$adsResult = mysqli_query($link, $query);
?>
<h2 class="form-title">List</h2>
<div class="list-container">
  <div class="filters">
    <div>Word</div>
    <div>Category</div>
    <div>Subcategory</div>
    <div>Price</div>
    <div>State</div>
    <div>City</div>
  </div>
  <ul class="ads-list">
    <?php
    while ($ad = mysqli_fetch_array($adsResult, MYSQLI_ASSOC)) {
    ?>
      <li>
        <a href="<?php echo "/ad.php?id=" . $ad['id'] ?>">
          <img src="<?php echo "images/uploaded/" . $ad['image']; ?>" />
          <div class="ad-container">
            <div class="ad-name"><?php echo $ad['name']; ?></div>
            <div class="ad-user-name">
              By: <?php echo $ad['user_name']; ?>
            </div>
            <div class="ad-price">$<?php echo $ad['price']; ?></div>
            <div class="ad-date"><?php echo $ad['date']; ?></div>
          </div>
        </a>
      </li>
    <?php
    }
    close($link);
    ?>
  </ul>
</div>
