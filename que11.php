<?php
function calculateShapeArea($base, $height, $shape) {

    $shape = strtolower($shape);

    if ($shape == "triangle") {
        return 0.5 * $base * $height;
    }
    elseif ($shape == "parallelogram") {
        return $base * $height;
    }
    else {
        return "Invalid shape";
    }
}

echo "Area of Triangle: " . calculateShapeArea(12, 10, "triangle") . "<br>";

echo "Area of Parallelogram: " . calculateShapeArea(12, 10, "parallelogram");
?>
