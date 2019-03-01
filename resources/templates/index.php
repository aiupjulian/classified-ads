<div class="hero-container">
    <div class="hero"></div>
    <div class="hero-text">
        <h2>Bienvenido a Classified Ads!</h2>
        <h3>Donde podes comprar y vender lo que quieras</h3>
        <p><b>Por favor registrate para empezar a comprar y vender!</b></p>
        <p><b>Si querés simplemente podes revisar avisos entre las subcategorías.</b></p>
    </div>
</div>
<div class="categories-title">
    <h3>Categorías</h3><a href="/list.php">Ver todas</a>
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
                    <?php echo $category['name'] ?>
                </div>
<?php
            if ($subcategoriesResult = mysqli_query($link, "SELECT * FROM subcategory WHERE subcategory.category_id = " . $category['id'])) {
                while($subcategory = mysqli_fetch_array($subcategoriesResult, MYSQLI_ASSOC)) {
?>
                <div class="subcategory">
                    <a href="list.php?subcategory=<?php echo $subcategory['id'] ?>">
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
