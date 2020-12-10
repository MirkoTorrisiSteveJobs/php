<?php

abstract class Poligon
{
    private $sides = [];

    abstract public function calcPerimeter();

    abstract public function calcArea();

}
class Triangle extends Poligon
{
    public function calcPerimeter()
    {
        $sum = 0;
        foreach ($this->sides as $side) {
            $sum += $side;
        }
        return $sum;
    }

    public function calcArea()
    {
        $hP = $this->calcPerimeter() / 2;
        return sqrt($hP * ($hP - $this->sides[0]) * ($hP - $this->sides[1]) * ($hP - $this->sides[2]));
    }
    public static function Scaleno($sideAB, $sideBC, $sideCA)
    {
        $triangle = new static();

        $triangle->sides = [$sideAB, $sideBC, $sideCA];
        if ($sideAB > $sideBC + $sideCA || $sideBC > $sideAB + $sideCA || $sideCA > $sideBC + $sideAB) {
            echo "This is not a triangle";
        } else {
            return $triangle;
        }

    }
    public static function Isoscele($sideAB, $sideCA)
    {
        $triangle = new static();

        $triangle->sides = [$sideAB, $sideAB, $sideCA];

        if ($sideCA >= $sideAB * 2) {
            echo "This is not a triangle";
        } else {
            return $triangle;
        }

    }
    public static function Equilatero($sideAB)
    {
        $triangle = new static();

        $triangle->sides = [$sideAB, $sideAB, $sideAB];

        return $triangle;
    }

}
class Quadrilater extends Poligon
{
    private $diagonalMaj = 0;
    private $diagonalMin = 0;
    public function calcPerimeter()
    {
        $sum = 0;
        foreach ($this->sides as $side) {
            $sum += $side;
        }
        return $sum;
    }
    public function calcArea()
    {
        if ($this->diagonalMaj != 0 && $this->diagonalMin != 0) {
            return ($this->diagonalMaj * $this->diagonalMin) / 2;
        } else {
            return $this->sides[0] * $this->sides[1];}
    }
    public static function Square($sideAB)
    {
        $quadrilater = new static();
        $quadrilater->sides = [$sideAB, $sideAB, $sideAB, $sideAB];
        return $quadrilater;
    }
    public static function Rectangle($sideAB, $sideBC)
    {
        $quadrilater = new static();
        $quadrilater->sides = [$sideAB, $sideBC, $sideAB, $sideBC];
        return $quadrilater;
    }
    public static function Diamond($diagonalMaj, $diagonalMin)
    {
        $quadrilater = new static();
        $quadrilater->diagonalMaj = $diagonalMaj;
        $quadrilater->diagonalMin = $diagonalMin;
        $side = sqrt(pow($diagonalMaj / 2, 2) + pow($diagonalMin / 2, 2));
        $quadrilater->sides = [$side, $side, $side, $side];

        return $quadrilater;
    }

}

$rettangolo1 = Quadrilater::Rectangle(10, 20);
$rettangolo2 = Quadrilater::Rectangle(15, 10);
$quadrato = Quadrilater::Square(10);
$rombo = Quadrilater::Diamond(10, 20);
$scaleno = Triangle::Scaleno(10, 20, 30);
$isoscele = Triangle::Isoscele(20, 10);
$equilatero = Triangle::Equilatero(10);
echo "\n Area del rettangolo 1 : \n ";
echo $rettangolo1->calcArea();
echo "\n Area del rettangolo 2 :\n ";
echo $rettangolo2->calcArea();
echo "\n Area del quadrato :\n ";
echo $quadrato->calcArea();
echo "\n Area del rombo :\n ";
echo $rombo->calcArea();
echo "\n Area del triangolo scaleno : \n ";
echo $scaleno->calcArea();
echo "\n Area del triangolo isoscele : \n ";
echo $isoscele->calcArea();
echo "\n Area del triangolo equilatero : \n ";
echo $equilatero->calcArea();
echo "\n Perimetro del rettangolo 1 : \n ";
echo $rettangolo1->calcPerimeter();
echo "\n  Perimetro del rettangolo 2 : \n";
echo $rettangolo2->calcPerimeter();
echo "\n Perimetro del quadrato : \n ";
echo $quadrato->calcPerimeter();
echo "\n Perimetro del rombo : \n ";
echo $rombo->calcPerimeter();
echo "\n Perimetro del triangolo scaleno : \n ";
echo $scaleno->calcPerimeter();
echo "\n Perimetro del triangolo isoscele : \n ";
echo $isoscele->calcPerimeter();
echo "\n Perimetro del triangolo equilatero : \n ";
echo $equilatero->calcPerimeter();
