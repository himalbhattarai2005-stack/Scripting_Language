<?php
$info = [
    'Name' => 'Ram Bahadur',
    'Address' => 'Lalitpur',
    'Email' => 'info@ram.com',
    'Phone' => 98454545,
    'Website' => 'www.ram.com'
];

echo "<table border='1' cellpadding='5' cellspacing='0'>";

foreach ($info as $key => $value) {
    echo "<tr><td><strong>$key</strong></td><td>$value</td></tr>";
}

echo "</table>";
?>
