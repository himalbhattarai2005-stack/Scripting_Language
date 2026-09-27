<?php
function convertToSeconds($minutes) {
    return $minutes * 60;
}

$minutes = 12;

echo "$minutes minutes is equal to " . convertToSeconds($minutes) . " seconds.";
?>
