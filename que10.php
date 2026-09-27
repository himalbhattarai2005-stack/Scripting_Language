<?php
function recursiveStrLen($str) {

    if ($str === "") {
        return 0;
    }

    return 1 + recursiveStrLen(substr($str, 1));
}

$testString = "Hello BCA Student";
echo "The length of '$testString' is: " . recursiveStrLen($testString);
?>
