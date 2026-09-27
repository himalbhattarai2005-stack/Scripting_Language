<?php
function carsNeeded($n) {

    return ceil($n / 5);
}

$people = 28;
echo "For $people people, cars needed: " . carsNeeded($people);
?>
