<?php
session_start();
require 'db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin_username'] = $username;
        header('Location: admin_dashboard.php');
        exit();
    } else {
        $message = '<p class="error">Wrong username or password.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body class="login-page">
    <div class="login-box">
        <h1>Admin Login</h1>
        <?php echo $message; ?>
        <form action="admin_login.php" method="post">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <p>No account? <a href="admin_register.php">Register here</a></p>
        <p><a href="index.php">Back to website</a></p>
    </div>
</body>
</html>
