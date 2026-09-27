<?php
$msg="";

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_FILES["cv"])){
    $f=$_FILES["cv"];
    $e=strtolower(pathinfo($f["name"],PATHINFO_EXTENSION));

    if($f["error"]!=UPLOAD_ERR_OK)
        $msg="File upload failed.";
    elseif(!in_array($e,["pdf","doc","docx"]))
        $msg="Only PDF and DOC/DOCX files are allowed.";
    elseif($f["size"]>=1024*1024)
        $msg="File size must be less than 1 MB.";
    else{
        $dir=__DIR__."/uploads/cv/";
        if(!is_dir($dir)) mkdir($dir,0777,true);
        move_uploaded_file($f["tmp_name"],$dir.uniqid("cv_",true).".".$e);
        $msg="CV uploaded successfully.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
<h2>Upload CV</h2>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="cv" accept=".pdf,.doc,.docx" required>
    <button>Upload</button>
</form>

<p><?=htmlspecialchars($msg)?></p>
</body>
</html>