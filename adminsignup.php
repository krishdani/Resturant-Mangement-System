<?php
$conn = new mysqli("localhost", "root", "", "ecommerceg");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    

    // Generate unique admin ID
    $admin_id = uniqid('admin_');

    // Check if username already exists
    $check = $conn->prepare("SELECT * FROM admin WHERE username=?");
    $check->bind_param("s", $username);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows > 0) {
        $error = "Username already taken!";
    } else {
        $stmt = $conn->prepare("INSERT INTO admin (admin_id, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $admin_id, $username, $password);
        $stmt->execute();

        header("Location: adminlogin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Signup</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-box {
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
    </style>
</head>
<body>
    <div class="signup-box">
        <h2>Admin Signup</h2>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Create a Username" required>
            <input type="password" name="password" placeholder="Create a Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p style="text-align:center; margin-top: 10px;">
            Already have an account? <a href="adminlogin.php">Login</a>
        </p>
    </div>
</body>
</html>
