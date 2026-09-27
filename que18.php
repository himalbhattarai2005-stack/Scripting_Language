<?php
function repeatFrontTwo($str) {

    if (strlen($str) < 2) {
        return $str;
    }

    $front = substr($str, 0, 2);

    return str_repeat($front, 4);
}

echo repeatFrontTwo("C Sharp") . "<br>";
echo repeatFrontTwo("JS") . "<br>";
echo repeatFrontTwo("a");
?>
