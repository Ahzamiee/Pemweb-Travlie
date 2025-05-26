<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['email'])) {
    header('Location: dashboard.php'); // atau halaman lain sesuai peran
    exit();
}
$error_message = "";
    if (isset($_SESSION['error'])) {
        $error_message = $_SESSION['error'];
        unset($_SESSION['error']);
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="style/styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="x-icon">
</head>

<body>
    <div class="login-container">
        <h2>Register Form</h2>
        <form action="register_process.php" method="post">
            <div class="input-group">
                <label for="full_name">Full Name*</label>
                <input type="text" name="full_name" placeholder="Enter your full name">
            </div>

            <div class="input-group">
                <label for="username">Email*</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">Password*</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="input-group">
                <label for="confirm_password">Confirm Password*</label>
                <input type="password" name="confirm_password" placeholder="Confirm your password" required>
            </div>

                <?php if (!empty($error_message)) : ?>
                    <div class="error-message">
                    <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

            <button type="submit" class="btn">Create Account</button>
        

            <p class="signup-text">
                Have an account? <a href="login.php">Sign in</a>
            </p>
        </form>
    </div>
</body>
</html>
