<?php
$r="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $p=filter_input(INPUT_POST,"principal",FILTER_VALIDATE_FLOAT);
    $rate=filter_input(INPUT_POST,"rate",FILTER_VALIDATE_FLOAT);
    $t=filter_input(INPUT_POST,"time",FILTER_VALIDATE_FLOAT);

    if($p===false||$rate===false||$t===false||$p===null||$rate===null||$t===null||$p<0||$rate<0||$t<0)
        $r="Enter valid non-negative values.";
    else{
        $si=$p*$rate*$t/100;
        $a=$p+$si;
        $r="Simple Interest = ".number_format($si,2).
           "<br>Total Amount = ".number_format($a,2);
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Simple Interest</h2>

<form method="post">
Principal: <input type="number" name="principal" step="any" min="0" required><br><br>
Rate (%): <input type="number" name="rate" step="any" min="0" required><br><br>
Time (years): <input type="number" name="time" step="any" min="0" required><br><br>
<button>Calculate</button>
</form>

<p><?=$r?></p>

</body>
</html>