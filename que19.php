<?php
function addLastChar($str) {

    if (strlen($str) < 1) {
        return $str;
    }

    $lastChar = substr($str, -1);

    return $lastChar . $str . $lastChar;
}

echo addLastChar("Red") . "<br>";
echo addLastChar("Green") . "<br>";
echo addLastChar("1");
?>
