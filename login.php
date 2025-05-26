<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
}
$error_message = "";
if (isset($_SESSION['error'])) {
    $error_message = $_SESSION['error'];
    unset($_SESSION['error']);
}
$success_message = "";
if (isset($_SESSION['sukses'])) {
    $success_message = $_SESSION['sukses'];
    unset($_SESSION['sukses']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style/styles.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="x-icon">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <?php if (!empty($success_message)) : ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form action="login_process.php" method="post">
            <div class="input-group">
                <label for="email">Email*</label>
                <input type="email" name="email" id="email" placeholder="Enter your Email">
            </div>

            <div class="input-group">
                <label for="password">Password*</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <?php if (!empty($error_message)) : ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <div class="forgot-password">
                <a href="forgot_password.php">Forgot password?</a>
            </div>

            <button type="submit" class="btn">Sign in</button>

            <p class="signup-text">
                Don't have an account? <a href="register.php">Sign up</a>
            </p>
        </form>
    </div>
</body>
</html>