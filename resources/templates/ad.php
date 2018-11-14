<?php
require_once(LIBRARY_PATH . "/databaseFunctions.php");
$link;
connect($link);

$ad_id = mysqli_real_escape_string($link, $_GET['id']);

$query = "SELECT ad.*, user.phone AS user_phone, user.name AS user_name, city.name AS city_name,"
  . " state.name AS state_name, subcategory.name AS subcategory_name, category.name AS category_name"
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
  $ad_user_name = $ad['user_name'];
  $ad_user_phone = $ad['user_phone'];
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once(LIBRARY_PATH . "/databaseFunctions.php");
  $link;
  connect($link);

  $text = mysqli_real_escape_string($link, $_POST['text']);

  // calculate current date
  $date_array = getdate();
  $date = $date_array['year'] . "-" . $date_array['mon'] . "-" . $date_array['mday'];
  // user_id from session
  $user_id = $_SESSION['id'];

  // validations
  // if () {
  //    $error = '';
  // } else if () {
  //    $error = '';
  // }

  if (!isset($error)) {
    $query = "INSERT INTO comment (ad_id, user_id, text, date) VALUES ('$ad_id', '$user_id', '$text', '$date')";
    if (!mysqli_query($link, $query)) {
      $error = "Error while trying to create comment.";
      // $ad_id = mysqli_insert_id($link);
      // header("location: ad.php?id=" . $ad_id);
    }
  }
  close($link);
}
?>
<h2 class="ad-title"><?php echo $name; ?></h2>
<div class="ad-container">
  <div class="ad-image">
    <img src="<?php echo "images/uploaded/" . $image; ?>" />
  </div>
  <div class="ad-details">
    <div>$<?php echo $price; ?></div>
    <div><b>Category:</b> <?php echo $category; ?></div>
    <div><b>Subcategory:</b> <?php echo $subcategory; ?></div>
    <div><b>Description:</b> <?php echo $description; ?></div>
    <div><b>City:</b> <?php echo $city; ?>, <?php echo $state; ?></div>
    <div><b>Date posted:</b> <?php echo $date; ?></div>

    <div><b>Username:</b> <?php echo $ad_user_name; ?></div>
    <div><b>Phone:</b> <?php echo $ad_user_phone; ?></div>

    <div><b>Sold:</b> <?php echo $sold; ?></div>


  </div>
</div>
<h2 class="comments-title">Comments</h2>
<div class="comments-container">
  <ul class="comments-list">
    <?php
    $link;
    connect($link);
    $commentsQuery = "SELECT comment.*, user.name AS user_name"
      . " FROM comment INNER JOIN user ON comment.user_id=user.id WHERE ad_id=" . $ad_id;
    $commentsResult = mysqli_query($link, $commentsQuery);
    while ($comment = mysqli_fetch_array($commentsResult, MYSQLI_ASSOC)) {
    ?>
      <li>
        <span class="comment-user-name"><?php echo $comment['user_name']; ?>:</span>
        <span class="comment-text">"<?php echo $comment['text']; ?>"</span>
        <span class="comment-date"><?php echo $comment['date']; ?></span>
      </li>
    <?php
    }
    close($link);
    ?>
  </ul>
  <?php if (isset($_SESSION['username'])) { ?>
    <form action="" method="post" class="form">
      <label for="text">Text:</label>
      <input type="text" name="text" maxlength="200" required/>
      <button class="button">Submit</button>
      <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
      <?php } ?>
    </form>
  <?php } ?>
</div>
