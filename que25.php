<form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" name="submit" value="Login">
</form>

<?php
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $valid_user = "admin";
    $valid_pass = "password123";

    if ($username === $valid_user && $password === $valid_pass) {
        echo "Login Successfully!! Welcome, $username.";
    } else {
        echo "Invalid Username or Password.";
    }
}
?>
