<?php
if (isset($_POST['userid']) && isset($_POST['password'])) {

    $userid = $_POST['userid'];
    $password = $_POST['password'];

    if ($userid === "admin" && $password === "1234") {
        echo "success";
    } else {
        echo "error";
    }
}
?>