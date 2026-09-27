<?php
echo "<pre>";

$intVar    = 12;
$floatVar  = 12.12;
$stringVar = "BCA Students";
$boolVar   = true;
$arrayVar  = array("PHP", "MySQL", "HTML");
$nullVar   = null;

echo "Integer: $intVar\n";
echo "Float: $floatVar\n";
echo "String: $stringVar\n";
echo "Boolean: " . ($boolVar ? "true" : "false") . "\n";
print "Null Value: "; print_r($nullVar);
echo "\n";

print_r($arrayVar);
var_dump($arrayVar);

echo "Type of \$intVar: " . gettype($intVar) . "\n";
var_dump(is_int($intVar));
var_dump(is_array($arrayVar));

echo "</pre>";
?>
