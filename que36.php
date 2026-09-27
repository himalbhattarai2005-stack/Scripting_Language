<?php
$slabs=[];$tax=0;$discount=0;$total=0;$net=0;$error="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $income=filter_input(INPUT_POST,"income",FILTER_VALIDATE_FLOAT);
    $gender=$_POST["gender"]??"";

    if($income===false||$income===null||$income<0)
        $error="Enter a valid non-negative taxable income.";
    elseif(!in_array($gender,["male","female"],true))
        $error="Select a valid gender.";
    else{
        $r=$income;
        $ranges=[
            [1000000,.01,"Up to NPR 1,000,000"],
            [500000,.10,"Next NPR 500,000 (1,000,001–1,500,000)"],
            [1000000,.20,"Next NPR 1,000,000 (1,500,001–2,500,000)"],
            [1500000,.27,"Next NPR 1,500,000 (2,500,001–4,000,000)"],
            [INF,.29,"Income above NPR 4,000,000"]
        ];

        foreach($ranges as [$limit,$rate,$label]){
            if($r<=0)break;

            $amount=min($r,$limit);
            $t=$amount*$rate;

            $slabs[]=[
                "label"=>$label,
                "taxable"=>$amount,
                "rate"=>$rate,
                "tax"=>$t
            ];

            $tax+=$t;
            $r-=$amount;
        }

        $discount=$gender=="female"?$tax*.10:0;
        $total=$tax-$discount;
        $net=$income-$total;
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2> Income Tax </h2>

<form method="post">
Annual Taxable Income:
<input type="number" name="income" min="0" step="0.01" required><br><br>

Gender:
<select name="gender" required>
<option value="">Select</option>
<option value="male">Male</option>
<option value="female">Female</option>
</select><br><br>

<button>Calculate Tax</button>
</form>

<p><?=$error?></p>

<?php if($slabs&&!$error): ?>

<h3>Tax Details</h3>
<p>Annual taxable income: NPR <?=number_format($income,2)?></p>

<table border="1" cellpadding="8">
<tr>
<th>Tax Slab</th><th>Taxable Amount</th><th>Rate</th><th>Tax</th>
</tr>

<?php foreach($slabs as $s): ?>
<tr>
<td><?=$s["label"]?></td>
<td>NPR <?=number_format($s["taxable"],2)?></td>
<td><?=$s["rate"]*100?>%</td>
<td>NPR <?=number_format($s["tax"],2)?></td>
</tr>
<?php endforeach; ?>

</table>

<p>Tax before female discount: NPR <?=number_format($tax,2)?></p>
<p>Female discount: NPR <?=number_format($discount,2)?></p>
<p><strong>Total tax payable: NPR <?=number_format($total,2)?></strong></p>
<p><strong>Net income after tax: NPR <?=number_format($net,2)?></strong></p>

<?php endif; ?>

</body>
</html>