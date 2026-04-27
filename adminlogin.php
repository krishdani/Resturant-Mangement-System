<?php
session_start();

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: adminlogin.php?logged_out=1");
    exit;
}

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit;
}

// Connect to DB
$conn = new mysqli("localhost", "root", "", "ecommerceg");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $admin = $res->fetch_assoc();
        if ($password === $admin['password']) { // No hashing used
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Admin user not found.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background-color: white;
            padding: 30px;
            padding-right: 50px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 320px;
        }
        h2 {
            text-align: center;
        }
        input {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
        }
        button {
            width: 108%;
            background: #2f3e46;
            color: white;
            padding: 10px;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
            text-align: center;
        }
        .success {
            color: green;
            font-size: 14px;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <?php
            if (!empty($error)) echo "<div class='error'>$error</div>";
            if (isset($_GET['logged_out'])) echo "<div class='success'>Logged out successfully.</div>";
        ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p style="text-align:center; margin-top: 10px;">
            If you Don't have account? <a href="adminsignup.php">Signup</a>
        </p>
        </form>
    </div>
</body>
</html>
