<?php
require_once(realpath(dirname(__FILE__) . "/../config.php"));
unset($error);
if (!isset($_SESSION['username'])) {
  header('location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once(LIBRARY_PATH . "/databaseFunctions.php");
  $link;
  connect($link);

  // post parameters
  $name = mysqli_real_escape_string($link, $_POST['name']);
  $description = mysqli_real_escape_string($link, $_POST['description']);
  $price = mysqli_real_escape_string($link, $_POST['price']);
  // calculate current date
  $date_array = getdate();
  $date = $date_array['year'] . "-" . $date_array['mon'] . "-" . $date_array['mday'];
  // user_id from session
  $user_id = $_SESSION['id'];

  $file_name = $_FILES['image']['name'];
  $file_size = $_FILES['image']['size'];
  $file_tmp = $_FILES['image']['tmp_name'];
  $file_error = $_FILES['image']['error'];
  $exploded_file_name = explode('.', $file_name);
  $file_ext = strtolower(end($exploded_file_name));

  $extensions = array('jpeg', 'jpg', 'png');

  if (in_array($file_ext, $extensions) === false) {
     $error = 'Extension not allowed, please choose a JPEG or PNG file.';
  } else if ($file_error === 2 || $file_size > 2000000) {
     $error = 'File size must be less than 2 MB.';
  }

  if (!isset($error)) {
    global $config;
    $image_path = sha1_file($file_tmp) . $date . $date_array['seconds'] . "." . $file_ext;
    $path_to_upload = $config["paths"]["images"]["uploads"] . "/" . $image_path;
    if (move_uploaded_file($file_tmp, $path_to_upload)) {
      $query = "INSERT INTO ad (name, description, price, date, user_id, image) VALUES ('$name', '$description', '$price', '$date', '$user_id', '$image_path')";
      if (mysqli_query($link, $query)) {
        $ad_id = mysqli_insert_id($link);
        header("location: ad.php?id=" . $ad_id);
      } else {
        $error = "Error while trying to create ad.";
      }
    } else {
      $error = 'There was a problem uploading the file.';
    }
  }
  close($link);
}
?>
<h2 class="form-title">Create Ad</h2>
<form action="" method="post" class="form" enctype="multipart/form-data">
  <label for="name">Name:</label>
  <input type="text" name="name" maxlength="15" required>
  <label for="description">Description:</label>
  <input type="text" name="description" maxlength="60" required>
  <label for="price">Price:</label>
  <input type="number" name="price" maxlength="11" required>
  <label for="image">Image:</label>
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
  <input type="file" name="image" accept="image/png, image/jpeg">
  <button class="button">Submit</button>
  <?php if (isset($error)) { ?>
    <div class="error"><?php echo $error; ?></div>
  <?php } ?>
</form>
