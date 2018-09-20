<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Simple Site</title>
    <link href="css/variables.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.css" rel="stylesheet">
    <style>
        <?php include 'css/variables.css'; ?>
        <?php include 'css/base.css'; ?>
        <?php include 'css/header.css'; ?>
        <?php include 'css/footer.css'; ?>
    </style>
</head>
<body>
<div class="header">
    <div class="header-section">
        <a href="index.php"><h1>Classified Ads</h1></a>
    </div>
    <div class="header-section">
        <input placeholder="What are you looking for?"/>
        <button class="button">Search</button>
    </div>
    <div class="header-section">
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    </div>
</div>
