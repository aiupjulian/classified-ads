<h2>Welcome to Classified Ads!</h2>
<?php
    require_once(LIBRARY_PATH . "/databaseFunctions.php");
    echo $setInIndexDotPhp;
    $link = connect();

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
