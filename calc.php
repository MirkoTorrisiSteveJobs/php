
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Home</title>
  <link rel="stylesheet" href="bootstrap.min.css" type="text/css">

  <link rel="stylesheet" href="style.css" type="text/css">
</head>
    <body>
        <?php
session_start();
if (isset($_POST['reset'])) {
    session_unset();
}
if (!isset($_SESSION['Calculator'])) {
    $_SESSION['Calculator'] = new Calculator();
} else {
    $calc = $_SESSION['Calculator'];
}

function checkInput($number)
{
    if (isset($number) && (is_numeric($number) || is_int($number))) {
        return true;
    } else {
        return false;
    }

}

?>
<div class="calculator">
        <form method="get" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">

            <input type="number" name="first_number" value="<?php echo isset($_GET['first_number']) ? $_GET['first_number'] : ""
?>">
            <input type="number" name="second_number" value="<?php echo isset($_GET['second_number']) ? $_GET['second_number'] : ""
?>">

            <label for="operations">Choose operation:</label>
            <select name="operation" id="operations">
                <option value="sum"<?php echo $_GET['operation'] == 'sum' ? ' selected ' : "" ?>>Somma</option>
                <option value="diff"<?php echo $_GET['operation'] == 'diff' ? ' selected ' : "" ?>>Differenza</option>
                <option value="mult"<?php echo $_GET['operation'] == 'mult' ? ' selected ' : "" ?>>Moltiplicazione</option>
                <option value="div"<?php echo $_GET['operation'] == 'div' ? ' selected ' : "" ?>>Divisione</option>
                <option value="sqrt"<?php echo $_GET['operation'] == 'sqrt' ? ' selected ' : "" ?>>Radice Quadrata</option>
                <option value="pow"<?php echo $_GET['operation'] == 'pow' ? ' selected ' : "" ?>>Potenza</option>
            </select>
            <input type="submit" name="submit" value="Submit">
        </form>
        </div>
        <?php

$first_number = $_GET["first_number"];
$second_number = $_GET["second_number"];
$operation = $_GET["operation"];
if (isset($_GET["submit"]) && isset($calc)) {

    $error = "Form incompleto o invalido!";

    if (checkInput($first_number)) {
        if ($operation == "sqrt") {
            $calc->doOperation($operation, $first_number, 0);
        } else
        if (checkInput($second_number)) {
            $calc->doOperation($operation, $first_number, $second_number);
        } else {
            echo $error;
        }
    } else {
        echo $error;
    }

}

class Calculator
{
    private $operations = [];

    public function doOperation($op, $a, $b)
    {

        $res = 0;
        switch ($op) {
            case "sum":
                $res = $a + $b;
                break;
            case "pow";
                $res = $a;
                for ($i = 1; $i < $b; $i++) {
                    $res *= $a;
                }
                break;
            case "sqrt":
                $res = sqrt($a);
                break;
            case "diff":
                $res = $a - $b;
                break;
            case "mult":
                $res = $a * $b;
                break;
            case "div":
                if ($b != 0 && $a != 0) {
                    $res = $a / $b;
                    break;
                } else {
                    echo "Lo zero non è ammesso";
                    break;
                }
            default:
                echo "Operazione non contemplata";
                break;

        }
        $this->addOperation(new Operation($op, $a, $b, $res));

    }
    public function getMostAndLessUsed()
    {
        $array_counter = ["sum" => 0, "mult" => 0, "sqrt" => 0, "pow" => 0, "diff" => 0, "div" => 0];
        foreach ($this->operations as $operation) {
            $array_counter[$operation->op_name]++;
        }
        $most_used = [];
        $less_used = [];
        foreach (array_keys($array_counter, max($array_counter)) as $key) {
            $most_used += [$key => $array_counter[$key]];
        }
        foreach (array_keys($array_counter, min($array_counter)) as $key) {
            $less_used += [$key => $array_counter[$key]];
        }
        return array($most_used, $less_used);
    }
    public function getOperations()
    {
        return $this->operations;
    }
    public function getOperationList($text)
    {
        $new_arr = [];
        foreach ($this->getOperations() as $operation) {
            if ($operation->op_name == $text) {
                array_push($new_arr, $operation);
            }
        }
        return $new_arr;
    }
    public function addOperation($operation)
    {

        array_push($this->operations, $operation);
    }

}
class Operation
{
    public $op_name;
    public $n1;
    public $n2;
    public $result;
    public function __construct($op_name, $n1, $n2, $result)
    {
        $this->op_name = $op_name;
        $this->n1 = $n1;
        $this->n2 = $n2;
        $this->result = $result;
    }
    public function __toString()
    {
        switch ($this->op_name) {
            case "sum":
                return "Sum " . $this->n1 . " + " . $this->n2 . " = " . $this->result;
            case "pow";
                return "Power " . $this->n2 . " of " . $this->n1 . " = " . $this->result;
            case "sqrt":
                return "Root of " . $this->n1 . " = " . $this->result;
            case "diff":
                return "Difference " . $this->n1 . " - " . $this->n2 . " = " . $this->result;
            case "mult":
                return "Multiplication " . $this->n1 . " x " . $this->n2 . " = " . $this->result;
            case "div":
                return "Division " . $this->n1 . " / " . $this->n2 . " = " . $this->result;
            default:
                return "";
        }
    }
}
?>
<?php if (isset($calc)): ?>
    <h2 class="display-5">
    <?php echo "Most used: ";

foreach ($calc->getMostAndLessUsed()[0] as $key_most => $most_used) {echo $key_most . " " . $most_used . " times, ";} ?> </h2>
    <h2 class="display-5">
<?php echo "Less used: ";
foreach ($calc->getMostAndLessUsed()[1] as $key_less => $less_used) {echo $key_less . " " . $less_used . " times,";} ?> </h2>
    <form action="" method="post">
    <input type="submit" name="reset" value="Reset" method="GET">
    </form>
<div class="container-fluid">


<div class="container">
<ul class="operations">
    <h1>Sums</h1>
    <?php foreach ($calc->getOperationList('sum') as $sumOperation) {
    echo '<li class="list-item">' . $sumOperation . "</li>";
}
?>
</ul>
</div>
<div class="container">
<ul class="operations">
    <h1>Divisions</h1>
    <?php foreach ($calc->getOperationList('div') as $divOperation) {
    echo '<li class="list-item">' . $divOperation . "</li>";
}
?>
</ul>
</div>
<div class="container">
<ul class="operations">
<h1>Subtractions</h1>
    <?php foreach ($calc->getOperationList('diff') as $diffOperation) {
    echo '<li class="list-item">' . $diffOperation . "</li>";
}
?>
</ul>
</div>
<div class="container">
<ul class="operations">
<h1>Multiplications</h1>
    <?php foreach ($calc->getOperationList('mult') as $multOperation) {
    echo '<li class="list-item">' . $multOperation . "</li>";
}
?>
</ul>
</div>
<div class="container">

<ul class="operations">
<h1>Power</h1>

    <?php foreach ($calc->getOperationList('pow') as $powOperation) {
    echo '<li class="list-item">' . $powOperation . "</li>";
}
?>
</ul>
</div>
<div class="container">
<ul class="operations">
<h1>Square Roots</h1>

    <?php foreach ($calc->getOperationList('sqrt') as $sqrtOperation) {
    echo '<li class="list-item">' . $sqrtOperation . "</li>";
}
?>
</ul>

</div>
<?php endif?>
</div>
    </body>
</html>
