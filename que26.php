<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    setcookie("user", "", time() - 3600, "/"); // Delete cookie by setting past expiry
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to same page
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];

    $_SESSION['username'] = $username;

    setcookie("user", $username, time() + 3600, "/");

    echo "Session and Cookie set for $username. <br>";
}
?>

<form method="post">
    Username: <input type="text" name="username" required>
    <input type="submit" name="submit" value="Login">
</form>

<?php
if (isset($_SESSION['username'])) {
    echo "You are logged in as: " . $_SESSION['username'] . "<br>";
    echo "Cookie value: " . (isset($_COOKIE['user']) ? $_COOKIE['user'] : "Not set") . "<br>";
    echo "<a href='?logout=true'>Logout</a>";
}
?>
