<?php
$msg="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $f=basename(trim($_POST["filename"]??""));
    $op=$_POST["operation"]??"";
    $txt=$_POST["text"]??"";
    $new=basename(trim($_POST["new_filename"]??""));

    if($f=="")$msg="Filename is required.";
    else{
        $p=__DIR__."/".$f;

        switch($op){
            case "check":
                $msg=file_exists($p)?"File exists.":"File does not exist.";
                break;

            case "open":
                $h=fopen($p,"a+");
                $msg=$h?"File opened successfully.":"Unable to open file.";
                if($h)fclose($h);
                break;

            case "write":
                $h=fopen($p,"w");
                if($h){
                    fwrite($h,$txt);fclose($h);
                    $msg="File written successfully.";
                }else $msg="Unable to write file.";
                break;

            case "read":
                if(file_exists($p)){
                    $h=fopen($p,"r");
                    $msg=fread($h,filesize($p));
                    fclose($h);
                }else $msg="File does not exist.";
                break;

            case "close":
                $msg="Any handle opened during this request is closed after use.";
                break;

            case "rename":
                if($new!=""&&file_exists($p))
                    $msg=rename($p,__DIR__."/".$new)?"File renamed successfully.":"Rename failed.";
                else $msg="Existing file and new filename are required.";
                break;

            case "permissions":
                $msg=file_exists($p)?
                    "Permissions (octal): ".substr(sprintf("%o",fileperms($p)),-4):
                    "File does not exist.";
                break;

            case "chmod":
                if(file_exists($p))
                    $msg=chmod($p,0644)?
                        "Permissions changed. New permissions: ".substr(sprintf("%o",fileperms($p)),-4):
                        "Unable to change permissions.";
                else $msg="File does not exist.";
                break;

            default:$msg="Select an operation.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>File Handling </h2>

<form method="post">
Filename: <input type="text" name="filename" placeholder="example.txt" required><br><br>

Operation:
<select name="operation" required>
<option value="check">Check File</option>
<option value="open">Open File</option>
<option value="write">Write File</option>
<option value="read">Read File</option>
<option value="close">Close File</option>
<option value="rename">Rename File</option>
<option value="permissions">Check Permissions</option>
<option value="chmod">Change Permissions</option>
</select><br><br>

Text for write:<br>
<textarea name="text"></textarea><br><br>

New filename for rename:
<input type="text" name="new_filename"><br><br>

<button>Perform Operation</button>
</form>

<hr>
<pre><?=htmlspecialchars($msg)?></pre>

</body>
</html>