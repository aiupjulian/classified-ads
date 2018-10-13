<div class="hero-container">
    <div class="hero">
        <h2>Welcome to Classified Ads!</h2>
        <h3>Where you can buy and sell everything</h3>
    </div>
</div>
<?php
    require_once(LIBRARY_PATH . "/databaseFunctions.php");
    echo $setInIndexDotPhp;
    $link;
    connect($link);

    if ($categoriesResult = mysqli_query($link, "SELECT * FROM category")) {
        while($category = mysqli_fetch_array($categoriesResult, MYSQLI_ASSOC)) {
?>
                <div> <?php echo "Name :{$category['name']}  <br> " ?> </div>
<?php
        }
        mysqli_free_result($categoriesResult);
    }
    close($link);
?>

<p>asdas</p><p>asdas</p><p>asdas</p><p>asdas</p><p>asdas</p>
<p>asdas</p><p>asdas</p><p>asdas</p><p>asdas</p><p>asdas</p>
<p>asdas</p><p>asdas</p><p>asdas</p><p>asdas</p><p>asdas</p>
<p>asdas</p><p>asdas</p>
