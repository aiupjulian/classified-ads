<?php
require_once(realpath(dirname(__FILE__) . "/../config.php"));
unset($error);
if (!isset($_SESSION['username'])) {
  header('location: index.php');
}

if (isset($_FILES['image'])) {
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
    $path_to_upload = sprintf($config["paths"]["images"]["uploads"].'/%s.%s', sha1_file($file_tmp), $file_ext);
    if (move_uploaded_file($file_tmp, $path_to_upload)) {
      echo 'Nice';
      // TODO: go to post
    } else {
      $error = 'There was a problem uploading the file.';
    }
  }
}
?>
<h2 class="ad-title">Create Ad</h2>
<form action="" method="post" class="ad" enctype="multipart/form-data">
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
    <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
  <?php } ?>
</form>
