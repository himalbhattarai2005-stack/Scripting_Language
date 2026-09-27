<?php
function findStringIndex($arr, $str) {

    $index = array_search($str, $arr);

    if ($index !== false) {
        return $index;
    }

    return "String not found in array";
}

$myArray = array("Apple", "Banana", "Cherry", "Date");

echo "Index of 'Apple': " . findStringIndex($myArray, "Apple");
?>
