<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['email'])) {
    header('Location: dashboard.php'); // atau halaman lain sesuai peran
    exit();
}
    session_start();
    $error_message = "";
    if (isset($_SESSION['error'])) {
        $error_message = $_SESSION['error'];
        unset($_SESSION['error']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="shortcut icon" href="favicon.ico" type="x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to right, #141e30, #243b55);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        background-image: url("assets/Foto.jpg"); 
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat; 
        height: 100vh; 
    }


    .login-container {
        background: rgba(255, 255, 255, 0.3); 
        padding: 30px;
        border-radius: 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(15px); 
        text-align: center;
        width: 90%;
        max-width:300px;
        color: #141e30;
        margin: 20px;
    }


    h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }


    .input-group {
        text-align: left;
        margin-bottom: 15px;
    }

    .input-group label {
        font-size: 14px;
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 8px;
        margin-top: 3px;
        background: rgba(255, 255, 255, 0.4); 
        color: black;
        font-size: 14px;
        outline: none;
        transition: 0.3s;
        max-width: 95%;
    }


    .input-group input:focus {
        background: rgba(255, 255, 255, 0.5);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.4);
    }


    .forgot-password {
        text-align: right;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .forgot-password a {
        color: #05f2ff;
        text-decoration: none;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    }

    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(to right, #4facfe, #00f2fe);
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn:hover {
        background: linear-gradient(to right, #00f2fe, #4facfe);
        box-shadow: 0 4px 15px rgba(79, 175, 254, 0.5);
    }


    .signup-text {
        font-size: 13px;
        margin-top: 15px;
    }

    .signup-text a {
        color:#05f2ff;
        text-decoration: none;
        font-weight: bold;
    }

    .signup-text a:hover {
        text-decoration: underline;
    }

    @media (max-width: 480px) {
        .login-container {
            width: 90%;
            padding: 20px;
        }
    }

    @media (min-width: 576px) {
        .login-container {
            padding: 30px;
        }

        h2 {
            font-size: 22px; 
        }

        .input-group input {
            padding: 10px;
        }

        .btn {
            padding: 12px; 
            font-size: 16px; 
        }
    }


    @media (min-width: 768px) and (max-width: 991px) {
        .login-container {
            position: relative;
            left : 2px; 
        }

        h2 {
            font-size: 24px; 
        }
    }


    @media (min-width: 992px) {
        .login-container {
            width: 90%; 
        }
    }


    @media (min-width: 1200px) {
        .login-container {
            width: 100%; 
        }
    }

    .error-message {
        background-color: rgba(255, 0, 0, 0.1);
        color: red;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 15px;
        font-size: 14px;
        font-weight: bold;
    }

    .success-message {
        background-color: rgba(0, 255, 0, 0.1);
        color: green;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-bottom: 15px;
        font-size: 14px;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Register Form</h2>
        <form action="register_process.php" method="post">
            <div class="input-group">
                <label for="full_name">Full Name*</label>
                <input type="text" name="full_name" placeholder="Enter your full name" required>
            </div>

            <div class="input-group">
                <label for="username">Email</label>
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

    <?php
        if (isset($_SESSION['sukses'])) {
            echo "<script>alert('" . $_SESSION['sukses'] ."');</script>";
            unset($_SESSION['sukses']);
        }
    ?>
</body>
</html>
