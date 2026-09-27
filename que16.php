<?php
function diffFrom71($n) {

    $diff = abs($n - 71);

    if ($n > 71) {
        return $diff * 3;
    }

    return $diff;
}

echo "Difference for 80: " . diffFrom71(80) . "<br>";
echo "Difference for 30: " . diffFrom71(30);
?>
