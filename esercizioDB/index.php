<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Home</title>
  <link rel="stylesheet" href="bootstrap.min.css" type="text/css">
</head>
<body>
<div class="container ">
<div class="d-flex flex-wrap justify-content-center">

<?php
session_start();
require_once 'manageDB.php';
$mysqli = openConnection('localhost', 'root', '');
useDb($mysqli, 'DB_esercizio');
if (isset($_GET['logout'])) {
    session_unset();
}
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    echo '<div class="d-flex flex-column">
    <h1 class="display-4">Ciao ' . $user['nome'] . ' ' . $user['cognome'] .
        '</h1><a href="accesses.php">Controlla tutti i tuoi accessi e i prodotti preferiti</a></div>
        <div class="d-flex flex-wrap">';
    $favorite_products = queryFavoritesByUser($mysqli, $user['id']);
    foreach (queryAllProducts($mysqli) as $product) {
        if (in_array($product['id'], $favorite_products)) {
            echo '<div class="card col-2 m-2"">
        <img class="card-img-top" src="' . $product['img_url'] . '" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">' . $product['product_name'] . '</h5>
          <p class="card-text">' . $product['price'] . ' €</p></div></div>';}
    }
    echo '</div></div><a href="?logout" class="btn btn-danger my-2">Log out</a>
    <form method="POST" class="form-group col-6 d-flex flex-column" action="index.php">
<label for="name">Name</label>
    <input type="text"name="nome"id="name" value="' . $user['nome'] . '" required>
    <label for="surname">Surname</label>
    <input type="text"name="cognome"id="surname" value="' . $user['cognome'] . '" required>
    <label for="dob">Date of Birth</label>
    <input type="date"name="dob" id="dob" value="' . $user['dob'] . ' required>
    <label for="email">Email address</label>
    <input type="email"name="email" id="email" value="' . $user['email'] . '" required>
    <label for="cf">Fiscal Code</label>
    <input type="text"name="cf" id="cf" value="' . $user['cf'] . '" required>
    <label for="city">City</label>
    <input type="text"name="citta" id="city" value="' . $user['citta'] . '" required>
    <label for="address">Address</label>
    <input type="text"name="indirizzo" id="address" value="' . $user['indirizzo'] . '" required>
    <button type="submit" class="btn btn-primary my-2" name="update">Update</button>
 ';

    if (isset($_POST['update'])) {
        foreach ($_POST as $key => $value) {
            if ($key != 'update') {
                if ($value != "") {
                    updateUser($mysqli, $user['id'], $key, $value);
                }
            }
        }
        $_SESSION['user'] = queryUser($mysqli, ['id' => $user['id']])[0];
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
closeConnection($mysqli);
?>

</div>
</body>