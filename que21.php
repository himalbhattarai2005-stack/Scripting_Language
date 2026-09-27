<?php
function findLargest($a, $b, $c) {

    if ($a >= $b && $a >= $c) {
        return $a;
    }
    elseif ($b >= $a && $b >= $c) {
        return $b;
    }
    else {
        return $c;
    }
}

echo "The largest among 12, 20, and 40 is: " . findLargest(12, 20, 40);
?>
