<?php
function compareStringLength($str1, $str2) {

    if (strlen($str1) === strlen($str2)) {
        return true;
    }

    return false;
}

var_dump(compareStringLength("Hello", "java"));
echo "<br>";

var_dump(compareStringLength("PHP", "Lab"));
?>
