<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Simple Site</title>
  <link href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <style>
    <?php include 'css/variables.css'; ?>
    <?php include 'css/base.css'; ?>
    <?php include 'css/header.css'; ?>
    <?php include 'css/footer.css'; ?>
  </style>
</head>
<body>
<?php session_start(); ?>
<div class="header">
  <div class="header-section">
    <a href="index.php"><h1>Classified Ads</h1></a>
  </div>
  <form action="/list.php" method="get" class="header-section">
    <input type="text" name="name" maxlength="15" required placeholder="What are you looking for?"/>
    <button class="button">Search</button>
  </form>
  <div class="header-section">
    <a href="list.php">List</a>
    <?php if (isset($_SESSION['username'])) { ?>
      <a href="sell.php">Sell</a>
      <a href="profile.php">Profile</a>
      <a href="logout.php">Logout</a>
    <?php } else { ?>
      <a href="register.php">Register</a>
      <a href="login.php">Login</a>
    <?php } ?>
  </div>
</div>
