<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Accesses</title>
  <link rel="stylesheet" href="bootstrap.min.css" type="text/css">

</head>
<body>
    <div class="d-flex">
    <div class="d-flex col-3 justify-content-start align-items-center flex-column">
    <a href="index.php" class="btn btn-primary my-2">Home</a>
<a href="index.php?logout" class="btn btn-danger my-2">Log out</a>

<h1 class="text-warning">Your accesses</h1>
<?php

session_start();
require_once 'manageDB.php';
$mysqli = openConnection('localhost', 'root', '');
useDb($mysqli, 'DB_esercizio');

$page = isset($_GET['page']) ? $_GET['page'] : 0;
$elems = isset($_GET['elems']) ? $_GET['elems'] : 5;
if (($user = $_SESSION['user'])) {
    foreach (queryAccess($mysqli, $user['id'], $page, $elems) as $access) {
        echo "<h3 class='font-weight-bold'>" . $access['date'] . "</h3>";
    }
    if (queryTableCount($mysqli, 'accesses', $user['id'])[0]["COUNT(*)"] > $elems) {
        echo '<nav aria-label="Page navigation">
    <ul class="pagination">';
        echo ($page > 0) ? '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '&elems=' . $elems . '">Previous</a></li>' : '';
        for ($i = 0; $i < (queryTableCount($mysqli, 'accesses', $user['id'])[0]["COUNT(*)"] / $elems) - 1; $i++) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '&elems=' . $elems . '">' . ($i + 1) . '</a></li>';
        }
        echo $page < queryTableCount($mysqli, 'accesses', $user['id'])[0]["COUNT(*)"] / $elems - 1 ? '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '&elems=' . $elems . '">Next</a></li></ul></nav>' : "</ul></nav>";
    }
}
?>
<form method="GET">
<select name="elems" id="elems">
  <option value="5">5</option>
  <option value="10">10</option>
  <option value="20">20</option>
</select>
    <input type="submit" value="Change Item size"class="btn btn-outline-secondary"/>
</form>
</div>
<div class="container-fluid p-5">

<h1 class="text-warning">All products</h1>

    <div class="d-flex flex-wrap justify-content-center">
<?php

if ($user = $_SESSION['user']) {
    if (isset($_GET['addFav'])) {
        createFavourite($mysqli, $user['id'], $_GET['addFav']);
    }
    if (isset($_GET['delFav'])) {
        deleteFavourite($mysqli, $user['id'], $_GET['delFav']);
    }
    $favorite_products = queryFavoritesByUser($mysqli, $user['id']);

    foreach (queryAllProducts($mysqli) as $product) {
        echo '<div class="card col-3 m-2"">
        <img class="card-img-top" src="' . $product['img_url'] . '" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">' . $product['product_name'] . '</h5>
          <p class="card-text">' . $product['price'] . ' €</p>';

        echo in_array($product['id'], $favorite_products) ? '<a href="?delFav=' . $product['id'] . '" class="btn btn-warning">Remove from favorites</a>' : '<a href="?addFav=' . $product['id'] . '" class="btn btn-primary">Add to favorites</a>';
        echo '</div>
      </div>';
    }}
closeConnection($mysqli);
?>
</div>
</body>