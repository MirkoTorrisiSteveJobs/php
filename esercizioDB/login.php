<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Home</title>
  <link rel="stylesheet" href="bootstrap.min.css" type="text/css">
</head>
<body>
<div class="d-flex vh-100 flex-column justify-content-center align-items-center">
<form method="POST" class="form-group col-4" action="login.php">
    <label for="email">Email address</label>
    <input type="email" class="form-control" name="email" id="email" required>
    <label for="password">Password</label>

    <input type="password"name="password" class="form-control" id="password" placeholder="password">
    <button type="submit" class="btn btn-primary my-2" name="submit">Log in</button>
    <a href="register.php">Sign in</a>
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
    if ($user = queryUser($mysqli, ['email' => $_POST['email'], 'password' => $_POST['password']])) {
        $_SESSION['user'] = $user[0];
        createAccess($mysqli, $user[0]['id']);
        header('Location: index.php');
    } else {
        echo "<p class='text-danger'>Wrong email or password!</p>";
    }

}
closeConnection($mysqli);
?>
</div>
</body>