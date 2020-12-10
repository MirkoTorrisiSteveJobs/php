<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title></title>
</head>
<body>

<?php
$a = $_GET['a'];
$b = $_GET['b'];
$c = $_GET['c'];

function sum($a, $b)
{
    return $a + $b;
}

function mult($a, $b)
{
    return $a * $b;
}

function diff($a, $b)
{
    return $a - $b;
}

function fact($a)
{
    $res = $a;
    while ($a > 1) {
        $a--;
        $res *= $a;
    }
    return $res;
}

function div($a, $b)
{
    return $a / $b;
}

function isTriangle($a, $b, $c)
{
    if ($a < ($b + $c) && $a > ($b - $c)) {
        if ($b < ($a + $c) && $b > ($a - $c)) {
            if ($c < ($a + $b) && $c > ($a - $b)) {
                return true;
            }
        }
    }
    return false;
}
function calcAreaEqui($a)
{
    return ((pow($a, 2) * sqrt(3)) / 4);
}
function calcAreaRect($a, $b, $c)
{
    $arr = array($a, $b, $c);
    sort($arr);
    return ($arr[0] * $arr[1]) / 2;
}
function calcArea($a, $b, $c)
{
    $halfp = ($a + $b + $c) / 2;
    return (sqrt($halfp * ($halfp - $a) * ($halfp - $b) * ($halfp - $c)));
}
function checkType($a, $b, $c)
{
    $arr = array($a, $b, $c);
    sort($arr);
    $res = '';
    if (sqrt($arr[0] * $arr[0] + ($arr[1] * $arr[1])) == $arr[2]) {
        $res = $res . '-rettangolo';
    }
    if ($a == $b && $b == $c) {
        return 'equilatero' . $res;
    } elseif ($a == $b || $a == $c || $b == $c) {
        return 'isoscele' . $res;
    } else {
        return 'scaleno' . $res;
    }
}

function calcTriangle($a, $b, $c)
{
    if (isTriangle($a, $b, $c)) {
        echo ('<p>è un Triangolo</p>');
        $res = checkType($a, $b, $c);
        echo 'triangolo ' . $res;
        echo '<br>calcolo dell area ';
        if (strpos($res, 'rettangolo') == false) {
            switch ($res) {
                case 'equilatero':
                    echo 'del triangolo equilatero ' . calcAreaEqui($a);
                case 'isoscele' || 'scaleno':
                    echo calcArea($a, $b, $c);
            }
        } else {
            echo 'del triangolo rettangolo ' . calcAreaRect($a, $b, $c);
        }

    } else {
        echo 'non è un triangolo';
    }

}
echo ('<br> SUM ' . $a . '+' . $b . "=");
echo (sum($a, $b));
echo ('<br> DIVISION ' . $a . '/' . $b . "=");
echo (div($a, $b));
echo ('<br> MULTIPLY ' . $a . '*' . $b . '=');
echo (mult($a, $b));
echo ('<br> DIFFERENCE ' . $a . '-' . $b . '=');
echo (diff($a, $b));
echo ('<br>FACTORIAL ' . $a . '=');
echo (fact($a));
echo ('<br>FACTORIAL ' . $b . '=');
echo (fact($b));
echo ('<br><br><br>------------Sides a=' . $a . ' b=' . $b . ' c=' . $c . '-----<br>');

calcTriangle($a, $b, $c);

?>
</body>