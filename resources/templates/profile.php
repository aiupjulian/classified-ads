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

echo $user['name'];
?>
