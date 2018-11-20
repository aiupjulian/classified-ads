<?php
require_once(LIBRARY_PATH . "/databaseFunctions.php");
$link;
connect($link);
if (isset($_GET["category"])) {
  $category = $_GET["category"];
}
if (isset($_GET["subcategory"])) {
  echo $_GET["subcategory"];
}

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
    $link;
    connect($link);
    $adsQuery = "SELECT ad.*, user.name AS user_name"
      . " FROM ad INNER JOIN user ON ad.user_id=user.id";
    $adsResult = mysqli_query($link, $adsQuery);
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
