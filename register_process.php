<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['sukses'])) {
    echo "<script>alert('" . $_SESSION['sukses'] . "');</script>";
    unset($_SESSION['sukses']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        $_SESSION['error'] = "Password does not match.";
        header('Location: register.php');
        exit();
    }

    // ✅ Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $mysqli = new mysqli('localhost', 'root', '', 'travlie');

    if ($mysqli->connect_errno) {
        $_SESSION['error'] = "Database connection failed: " . $mysqli->connect_error;
        header('Location: register.php');
        exit();
    }

    $check = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "Email sudah terdaftar, gunakan email lain.";
        $check->close();
        $mysqli->close();
        header('Location: register.php');
        exit();
    }
    $check->close();

    if (!empty($fullname)) {
        $stmt = $mysqli->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullname, $email, $hashed_password);
    } else {
        $stmt = $mysqli->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashed_password);
    }   

    if ($stmt->execute()) {
        $_SESSION['sukses'] = "Successfully registered, please log in.";
        header('Location: login.php');
        exit();
    } else {
        $_SESSION['error'] = "Error saving data: " . $stmt->error;
        header('Location: register.php');
        exit();
    }

    $stmt->close();
    $mysqli->close();
}
?>
