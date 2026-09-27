<?php
function ageToDays($ageInYears) {
    return $ageInYears * 365;
}

$age = 21;

echo "Age in years: $age";
echo "<br>";

echo "Age in days: " . ageToDays($age);
?>
