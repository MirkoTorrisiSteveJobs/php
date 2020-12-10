
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Home</title>
  <link rel="stylesheet" href="bootstrap.min.css" type="text/css">
</head>
<body>
<div class="d-flex vh-100 flex-column justify-content-center align-items-center">
<form method="POST" class="form-group col-6 d-flex flex-column" action="register.php">
<label for="name">Name</label>

    <input type="text"name="nome"id="name" placeholder="nome" required>
    <label for="surname">Surname</label>
    <input type="text"name="cognome"id="surname" placeholder="surbame" required>
    <label for="dob">Date of Birth</label>
    <input type="date"name="dob" id="dob" required>
    <label for="email">Email address</label>
    <input type="email"name="email" id="email" placeholder="email" required>
    <label for="cf">Fiscal Code</label>
    <input type="text"name="cf" id="cf" placeholder="fiscal code" required>
    <label for="city">City</label>
    <input type="text"name="citta" id="city"  required>
    <label for="address">Address</label>

    <input type="text"name="indirizzo" id="address" required>
    <label for="email">Email address</label>

    <input type="password"name="password" placeholder="password">
    <input type="password"name="rep_password" placeholder="ripeti password">
    <button type="submit" class="btn btn-primary my-2" name="submit">Register</button>
</form>
<?php
session_start();
require_once 'manageDB.php';
$mysqli = openConnection('localhost', 'root', '');
useDb($mysqli, 'DB_esercizio');
if (isset($_SESSION['user'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    if (!queryUser($mysqli, ['email' => $_POST['email']])) {
        if ($_POST['password'] == $_POST['rep_password']) {
            if ($user = createUser($mysqli, $_POST['nome'], $_POST['cognome'], $_POST['dob'], $_POST['email'], $_POST['cf'], $_POST['citta'], $_POST['indirizzo'], $_POST['password'])) {
                header('Location: login.php');
            }
        } else {
            echo "<p class='text-danger'>Password mismatch</p>";
        }
    } else {
        echo "<p class='text-danger'>This email is already in use, try to log in</p>";
    }

    closeConnection($mysqli);
}?>
</div>
</body>