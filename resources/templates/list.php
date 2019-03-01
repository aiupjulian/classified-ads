<?php
require_once(LIBRARY_PATH . "/databaseFunctions.php");
$link;
connect($link);
$conditions = array();
if (!empty($_GET["name"])) {
  $conditions[] = "ad.name LIKE '%" . mysqli_real_escape_string($link, $_GET["name"]) . "%'";
}
if (!empty($_GET["subcategory"])) {
  $conditions[] = "subcategory_id=" . mysqli_real_escape_string($link, $_GET["subcategory"]);
}
if (!empty($_GET["city"])) {
  $conditions[] = "city_id=" . mysqli_real_escape_string($link, $_GET["city"]);
}
if (!empty($_GET["price1"]) && !empty($_GET["price2"])) {
  $conditions[] = "price BETWEEN " . mysqli_real_escape_string($link, $_GET["price1"]) . " AND " . mysqli_real_escape_string($link, $_GET["price2"]);
} else if (!empty($_GET["price1"])) {
  $conditions[] = "price>=" . mysqli_real_escape_string($link, $_GET["price1"]);
} else if (!empty($_GET["price2"])) {
  $conditions[] = "price<=" . mysqli_real_escape_string($link, $_GET["price2"]);
}
$conditions[] = "sold=0";

$query = "SELECT ad.*, user.name AS user_name";
$countQuery = "SELECT COUNT(*) AS count";
$search = " FROM ad INNER JOIN user ON ad.user_id=user.id";
if (count($conditions) > 0) {
  $search .= " WHERE " . implode(" AND ", $conditions);
}
$query .= $search;
$countQuery .= $search;
$adsCountResult = mysqli_query($link, $countQuery);
$adsCount = mysqli_fetch_array($adsCountResult, MYSQLI_ASSOC);
$count = $adsCount['count'];
$adsPerPage = 2;
$pages = ceil($count / $adsPerPage);
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start = ($page - 1) * $adsPerPage;
$query .= " LIMIT " . $start . "," . $adsPerPage;
$adsResult = mysqli_query($link, $query);
?>
<h2 class="form-title">Listado</h2>
<div class="list-container">
  <form action="" method="get" class="filters">
    <label for="name">Nombre:</label>
    <input type="text" name="name" maxlength="15" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '' ?>">
    <fieldset>
      <legend>Precio:</legend>
      <input type="number" name="price1" maxlength="11" placeholder="From" value="<?php echo isset($_GET['price1']) ? $_GET['price1'] : '' ?>">
      <input type="number" name="price2" maxlength="11" placeholder="To" value="<?php echo isset($_GET['price2']) ? $_GET['price2'] : '' ?>">
    </fieldset>
    <label for="city">Ciudad:</label>
    <select name="city">
      <?php if (empty($_GET["city"])) { ?>
        <option disabled selected value>Seleccione una ciudad</option>
      <?php
      }
      $statesQuery = "SELECT * FROM state";
      $statesResult = mysqli_query($link, $statesQuery);
      while ($state = mysqli_fetch_array($statesResult, MYSQLI_ASSOC)) {
      ?>
        <optgroup label="<?php echo $state['name']; ?>">
        <?php
        $citiesQuery = "SELECT * FROM city where state_id=" . $state['id'];
        $citiesResult = mysqli_query($link, $citiesQuery);
        while ($city = mysqli_fetch_array($citiesResult, MYSQLI_ASSOC)) {
        ?>
          <option value=<?php echo $city['id']; ?> <?php echo (!empty($_GET['city']) && $_GET['city'] == $city['id']) ? 'selected="selected"' : ''; ?>>
            <?php echo $city['name'] ?>
          </option>
        <?php } ?>
        </optgroup>
      <?php
      }
      ?>
    </select>
    <label for="subcategory">Subcategorías:</label>
    <select name="subcategory">
      <?php if (empty($_GET["subcategory"])) { ?>
        <option disabled selected value>Seleccione una subcategoría</option>
      <?php
      }
      $categoryQuery = "SELECT * FROM category";
      $categoryResult = mysqli_query($link, $categoryQuery);
      while ($category = mysqli_fetch_array($categoryResult, MYSQLI_ASSOC)) {
      ?>
        <optgroup label="<?php echo $category['name']; ?>">
        <?php
        $subcategoriesQuery = "SELECT * FROM subcategory where category_id=" . $category['id'];
        $subcategoriesResult = mysqli_query($link, $subcategoriesQuery);
        while ($subcategory = mysqli_fetch_array($subcategoriesResult, MYSQLI_ASSOC)) {
        ?>
          <option value=<?php echo $subcategory['id']; ?> <?php echo (!empty($_GET['subcategory']) && $_GET['subcategory'] == $subcategory['id']) ? 'selected="selected"' : ''; ?>>
            <?php echo $subcategory['name'] ?>
          </option>
        <?php } ?>
        </optgroup>
      <?php
      }
      ?>
    </select>
    <button class="button">Buscar</button>
  </form>
  <ul class="ads-container">
    <div class="ads-list">
    <?php
    while ($ad = mysqli_fetch_array($adsResult, MYSQLI_ASSOC)) {
    ?>
      <li>
        <a href="<?php echo "/ad.php?id=" . $ad['id'] ?>">
          <div class="image-container"><img alt="<?php echo "Image for Ad " . $ad['name']; ?>" src="<?php echo "images/uploaded/" . $ad['image']; ?>" /></div>
          <div class="ad-container">
            <div class="ad-name"><?php echo $ad['name']; ?></div>
            <div class="ad-user-name">
              Creado por: <?php echo $ad['user_name']; ?>
            </div>
            <div class="ad-price">$<?php echo $ad['price']; ?></div>
            <div class="ad-date"><?php echo $ad['date']; ?></div>
          </div>
        </a>
        <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"])  { ?>
          <div class="ad-delete-admin"><a href="<?php echo "/deleteAd.php?id=" . $ad['id'] ?>">Eliminar este aviso</a></div>
        <?php } ?>
      </li>
    <?php
    }
    close($link);
    ?>
    </div>
    <div class="ads-pagination">
      <?php
      if ($pages > 1) {
        for ($i = 1; $i <= $pages; $i++) {
          $query = $_GET;
          $query['page'] = $i;
          $query_result = http_build_query($query);
          if ($page == $i) echo "<span>" . $page . "</span>";
          else echo "<a href='list.php?" . $query_result ."'>" . $i . "</a>";
        }
      }
      ?>
    </div>
  </ul>
</div>
