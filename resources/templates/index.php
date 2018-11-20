<div class="hero-container">
    <div class="hero">
        <h2>Welcome to Classified Ads!</h2>
        <h3>Where you can buy and sell everything</h3>
    </div>
</div>
<div class="categories-title">
    <h3>Categories</h3><a href="/list.php">See All</a>
</div>
<div class="categories-list">
<?php
    require_once(LIBRARY_PATH . "/databaseFunctions.php");
    $link;
    connect($link);

    if ($categoriesResult = mysqli_query($link, "SELECT * FROM category")) {
        while($category = mysqli_fetch_array($categoriesResult, MYSQLI_ASSOC)) {
?>
            <div class="category">
                <div class="category-title">
                    <a href="list.php?category=<?php echo $category['name'] ?>">
                        <?php echo $category['name'] ?>
                    </a>
                </div>
<?php
            if ($subcategoriesResult = mysqli_query($link, "SELECT * FROM subcategory WHERE subcategory.category_id = " . $category['id'])) {
                while($subcategory = mysqli_fetch_array($subcategoriesResult, MYSQLI_ASSOC)) {
?>
                <div class="subcategory">
                    <a href="list.php?subcategory=<?php echo $subcategory['name'] ?>">
                        <?php echo $subcategory['name'] ?>
                    </a>
                </div>
<?php
                }
                mysqli_free_result($subcategoriesResult);
            }
?>
            </div>
<?php
        }
        mysqli_free_result($categoriesResult);
    }
    close($link);
?>
</div>
