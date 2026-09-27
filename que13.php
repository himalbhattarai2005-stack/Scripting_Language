<?php
function getValueByIndex($arr, $index) {

    if (isset($arr[$index])) {
        return $arr[$index];
    }

    return "Index out of bounds";
}

$myArray = array("White", "Blue", "Yellow");

echo "Value at index 2: " . getValueByIndex($myArray, 2);
?>
