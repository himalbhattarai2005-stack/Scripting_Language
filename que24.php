<?php
$s=[
["sn"=>1,"name"=>"Rajesh","roll"=>25,"webtech2"=>56,"dbms"=>89,"economics"=>57,"dsa"=>64,"account"=>98],
["sn"=>2,"name"=>"hari","roll"=>5,"webtech2"=>56,"dbms"=>89,"economics"=>57,"dsa"=>64,"account"=>98],
["sn"=>3,"name"=>"Shyam","roll"=>6,"webtech2"=>54,"dbms"=>79,"economics"=>57,"dsa"=>69,"account"=>98],
["sn"=>4,"name"=>"Rita","roll"=>10,"webtech2"=>16,"dbms"=>89,"economics"=>56,"dsa"=>64,"account"=>98],
["sn"=>5,"name"=>"Gita","roll"=>4,"webtech2"=>56,"dbms"=>89,"economics"=>57,"dsa"=>69,"account"=>98],
["sn"=>6,"name"=>"Sita","roll"=>24,"webtech2"=>56,"dbms"=>99,"economics"=>57,"dsa"=>24,"account"=>98]

];

foreach($s as &$r){
    $r["total"]=$r["webtech2"]+$r["dbms"]+$r["economics"]+$r["dsa"]+$r["account"];
    $r["result"]=min($r["webtech2"],$r["dbms"],$r["economics"],$r["dsa"],$r["account"])>=40?"pass":"fail";
}
unset($r);

function table($s,$alt=false){
?>
<table>
<tr>
<th>SN</th><th>Name</th><th>Roll</th><th>Web Tech II</th><th>DBMS</th>
<th>Economics</th><th>DSA</th><th>Account</th><th>Total</th><th>Result</th>
</tr>
<?php foreach($s as $i=>$r):
$bg=$alt?($i%2?"#aaaaaa":"#1c1c1c"):($r["result"]=="pass"?"#2ecc71":"#e74c3c");
$c=$alt?($i%2?"#000":"#fff"):"#000";
?>
<tr style="background:<?=$bg?>;color:<?=$c?>">
<td><?=$r["sn"]?></td><td><?=$r["name"]?></td><td><?=$r["roll"]?></td>
<td><?=$r["webtech2"]?></td><td><?=$r["dbms"]?></td><td><?=$r["economics"]?></td>
<td><?=$r["dsa"]?></td><td><?=$r["account"]?></td><td><?=$r["total"]?></td>
<td style="background:<?=$r["result"]=="pass"?"#2ecc71":"#e74c3c"?>;color:#fff"><?=$r["result"]?></td>
</tr>
<?php endforeach;?>
</table>
<?php } ?>

<!DOCTYPE html>
<html>
<head>
<title>Student Mark Sheet</title>
<style>
body{font-family:Arial;font-size:10px}
table{border-collapse:collapse;width:75%;margin:10px auto}
th,td{border:1px solid #333;padding:3px 4px;text-align:center}
th{font-size:9px}
h2{font-size:16px}
</style>

</head>
<body>

<h2>Mark Ledger</h2>
<?php table($s); ?>

<h2>Alternate Color</h2>
<?php table($s,true); ?>

</body>
</html>