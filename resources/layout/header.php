<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Classified Ads</title>
  <link href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
  <style>
    <?php include 'css/variables.css'; ?>
    <?php include 'css/base.css'; ?>
    <?php include 'css/header.css'; ?>
    <?php include 'css/footer.css'; ?>
    <?php
      if (file_exists($GLOBALS['contentFileFullPath']) && file_exists($GLOBALS['styleFileFullPath'])) {
        require_once($GLOBALS['styleFileFullPath']);
      }
    ?>
  </style>
</head>
<body>
<?php session_start(); ?>
<div class="header">
  <div class="header-section">
    <h1><a href="index.php">Classified Ads</a></h1>
  </div>
  <form action="/list.php" method="get" class="header-section">
    <input type="text" name="name" maxlength="15" placeholder="What are you looking for?" />
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
