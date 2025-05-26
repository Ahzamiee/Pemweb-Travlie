<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $mysqli = new mysqli('localhost', 'root', '', 'travlie');

    if ($mysqli->connect_errno) {
        $_SESSION['error'] = "Database connection failed: " . $mysqli->connect_error;
        header('Location: login.php');
        exit();
    }

    $stmt = $mysqli->prepare("SELECT fullname, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($fullname, $stored_password);

    if ($stmt->num_rows > 0 && $stmt->fetch()) {
        if (password_verify($password, $stored_password)) {
            $_SESSION['email'] = $email;
            $_SESSION['fullname'] = $fullname;
            header('Location: dashboard.php');
            exit();
        } else {
            $_SESSION['error'] = "Password salah!";
        }
    } else {
        $_SESSION['error'] = "Email tidak ditemukan!";
    }

    $stmt->close();
    $mysqli->close();
    header('Location: login.php');
    exit();
}
?>
