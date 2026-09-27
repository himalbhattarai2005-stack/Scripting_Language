<?php
function addFirstThree($str) {

    $front = substr($str, 0, 3);

    return $front . $str . $front;
}

echo addFirstThree("Python") . "<br>";
echo addFirstThree("JS") . "<br>";
echo addFirstThree("Code");
?>
