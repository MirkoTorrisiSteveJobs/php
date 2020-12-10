<?php
session_start();
?>
<form method="POST" action="cities.php">
    <input type="text"name="cities" placeholder="inserisci le tue città preferite separate da una virgola">
    <input type="submit" value="invia">

</form>
<?php
if (isset($_POST['cities']) && $_POST['cities'] != '') {
    $arr = explode(',', $_POST['cities']);
    foreach ($arr as $city_to_append) {
        if (!in_array($city_to_append, $_SESSION['cities_arr'])) {
            array_push($_SESSION['cities_arr'], $city_to_append);
        } else {
            echo $city_to_append . " è già inserita<br>";
        }
    }
}
if (isset($_GET['del'])) {
    if ($_GET['del'] == 'all') {
        $_SESSION['cities_arr'] = [];
    } else {
        $_SESSION['cities_arr'] = array_diff($_SESSION['cities_arr'], array($_GET['del']));
    }

}
echo ('<ul class="list">');
foreach ($_SESSION['cities_arr'] as $city) {
    echo ('<li>' . $city . ' <a href="?del=' . $city . '">Elimina</a></li>');
}
echo ('</ul>');
echo ('<a href="?del=all">Elimina tutto</a>')
?>