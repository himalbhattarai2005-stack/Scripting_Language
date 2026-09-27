<?php
function sumOrTriple($num1, $num2) {

    if ($num1 == $num2) {
        return ($num1 + $num2) * 3;
    }

    return $num1 + $num2;
}

echo "Sum of 12 and 6: " . sumOrTriple(12, 6) . "<br>";
echo "Sum of 21 and 10: " . sumOrTriple(21, 10);
?>
