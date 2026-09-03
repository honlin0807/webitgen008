<?php
require 'db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    $check_sql = "SELECT username FROM admin_users WHERE username='$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $message = '<p class="error">Username already exists.</p>';
    } elseif ($password != $confirm_password) {
        $message = '<p class="error">Passwords do not match.</p>';
    } else {
        $sql = "INSERT INTO admin_users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql)) {
            $message = '<p class="success">Registration successful. Please login.</p>';
        } else {
            $message = '<p class="error">Registration failed.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body class="login-page">
    <div class="login-box">
        <h1>Register Admin</h1>
        <p>You can use a simple password such as 1234.</p>
        <?php echo $message; ?>
        <form action="admin_register.php" method="post">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="admin_login.php">Login here</a></p>
    </div>
</body>
</html>
