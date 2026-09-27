<?php
function uppercaseLastThree($str) {

    if (strlen($str) < 3) {
        return strtoupper($str);
    }

    $front = substr($str, 0, -3);
    $lastThree = substr($str, -3);

    return $front . strtoupper($lastThree);
}

echo uppercaseLastThree("Nepal") . "<br>";
echo uppercaseLastThree("Npl") . "<br>";
echo uppercaseLastThree("Bca") . "<br>";
echo uppercaseLastThree("Bachelor");
?>
