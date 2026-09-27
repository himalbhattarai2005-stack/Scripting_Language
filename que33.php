<?php
$msg="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $to=filter_var($_POST["email"]??"",FILTER_VALIDATE_EMAIL);
    $sub=trim($_POST["subject"]??"");
    $body=trim($_POST["message"]??"");

    if(!$to||$sub==""||$body=="")
        $msg="Please provide a valid email, subject, and message.";
    elseif(mail($to,$sub,$body,"From: noreply@example.com"))
        $msg="Email notification sent.";
    else
        $msg="Email could not be sent. Configure the mail server first.";
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Send Email Notification</h2>

<form method="post">
Email: <input type="email" name="email" required><br><br>
Subject: <input type="text" name="subject" required><br><br>
Message:<br>
<textarea name="message" required></textarea><br><br>
<button>Send</button>
</form>

<p><?=$msg?></p>

</body>
</html>