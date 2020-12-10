<?php
function openConnection($host, $username, $password)
{
    $mysqli = new mysqli($host, $username, $password);
    if ($mysqli->connect_error) {
        die('Errore di connessione (codice errore: ' . $mysqli->connect_errno . ') messaggio errore: ' . $mysqli->connect_error);
    } else {
        return $mysqli;
    }
}
function closeConnection($mysqli)
{
    mysqli_close($mysqli);
}
function createDb($mysqli, $db_name)
{
    $query_string = "CREATE DATABASE $db_name";
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    }
}
function useDb($mysqli, $db_name)
{

    $query_string = "USE $db_name";
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    }
}

function createTableUsers($mysqli)
{
    $query_string_create_users = "CREATE TABLE users ( `id` INT(10) NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`) ,
`nome` VARCHAR(50) NOT NULL ,
`cognome` VARCHAR(50) NOT NULL ,
`dob` VARCHAR(50) NOT NULL ,
`email` VARCHAR(50) NOT NULL ,
`cf` VARCHAR(50) NOT NULL ,
`citta` VARCHAR(50) NOT NULL ,
`indirizzo` VARCHAR(50) NOT NULL ,
`password` VARCHAR(256) NOT NULL )";
    $res = $mysqli->query($query_string_create_users);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }

}
function createTableProducts($mysqli)
{

    $query_string_create_products = "CREATE TABLE products ( `id` INT(10) NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`) ,
`product_name` VARCHAR(50) NOT NULL ,
`price` INT(10) NOT NULL,
`img_url` VARCHAR(200) NOT NULL )";
    $res = $mysqli->query($query_string_create_products);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }

}

function createTableFavourites($mysqli)
{
    $query_string = "CREATE TABLE favourites ( `id` INT(10) NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`) ,
    `user_id` VARCHAR(50) NOT NULL ,
    `product_id` INT(10) NOT NULL )";
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }

}

function createTableAcesses($mysqli)
{
    $query_string = "CREATE TABLE accesses ( `id` INT(10) NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`) ,
    `user_id` INT(10) NOT NULL ,
    `date` DATETIME NOT NULL)";
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }

}
function createUser($mysqli, $nome, $cognome, $dob, $email, $cf, $citta, $indirizzo, $password)
{
    $password_hash = hash('sha256', $password);
    $query_string = "INSERT INTO users (`nome`, `cognome`, `dob`, `email`,`cf`,`citta`,`indirizzo`, `password`) VALUES
('$nome', '$cognome', '$dob', '$email','$cf','$citta','$indirizzo','$password_hash')";
    $res = $mysqli->query($query_string);

    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }

}

function createProduct($mysqli, $product_name, $price, $img_url)
{
    $query_string = "INSERT INTO products (`product_name`, `price`,`img_url`) VALUES('$product_name', '$price', '$img_url')";
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }

}
function createFavourite($mysqli, $user_id, $product_id)
{
    $query_string = "INSERT INTO favourites (`user_id`,`product_id`) VALUES('$user_id', '$product_id')";
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }

}
function deleteFavourite($mysqli, $user_id, $product_id)
{
    $query_string = "DELETE FROM favourites WHERE user_id='$user_id' AND product_id= '$product_id'";
    $res = $mysqli->query($query_string);
    if (!$res) {
        echo $mysqli->error;
    } else {
        return $res;
    }

}
function createAccess($mysqli, $user_id)
{

    $query_string = "INSERT INTO accesses (`user_id`, `date`) VALUES ('$user_id',now())";
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }
}

function queryUser($mysqli, $values)
{
    $query_string = "SELECT * FROM users WHERE ";
    foreach ($values as $key => $value) {
        if ($key == 'password') {
            $value = hash('sha256', $value);
        }
        $query_string .= "$key = '$value' AND ";
    }
    $query_string = substr($query_string, 0, -4);

    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res->fetch_all(MYSQLI_ASSOC);
    }

}
function queryAllProducts($mysqli)
{
    $query_string = "SELECT * FROM products";

    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res->fetch_all(MYSQLI_ASSOC);
    }

}
function queryTableCount($mysqli, $table_name, $user_id)
{
    $res = $mysqli->query("SELECT COUNT(*) FROM $table_name WHERE user_id='$user_id'");
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res->fetch_all(MYSQLI_ASSOC);
    }
}
function queryAccess($mysqli, $user_id, $param, $elems)
{

    $query_string = "SELECT * FROM accesses WHERE user_id='$user_id' ORDER BY date desc LIMIT " . (5 * $param) . "," . $elems;
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res->fetch_all(MYSQLI_ASSOC);
    }

}

function queryFavoritesByUser($mysqli, $user_id)
{
    $query_string = "SELECT product_id FROM favourites WHERE user_id='$user_id'";

    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        $favorite_products = [];
        foreach ($res->fetch_all(MYSQLI_ASSOC) as $product_raw) {
            array_push($favorite_products, $product_raw['product_id']);
        }
        return $favorite_products;
    }

}

function updateUser($mysqli, $id, $key, $value)
{
    $query_string = "UPDATE users SET $key = '$value' WHERE  id = '$id'";
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }}

function deleteUser($mysqli, $id)
{
    $query_string = "DELETE FROM users WHERE id = '$id'";
    $res = $mysqli->query($query_string);
    if (!$res) {
        return $mysqli->error;
    } else {
        return $res;
    }
}
