<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['user_name']);
    $password = trim($_POST['pas']);
    $captcha_input = trim($_POST['captcha']);

    // بررسی کپچا
    if(!isset($_SESSION['captcha']) || strtolower($captcha_input) !== strtolower($_SESSION['captcha'])) {
       
    } else {
        $conn = new mysqli("localhost", "root", "", "ahmad");
        if ($conn->connect_error) {
            die("❌ خطا در اتصال به دیتابیس: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM tariq WHERE user_name = ? AND pas = ?");
        if (!$stmt) {
            die("❌ خطا در prepare: " . $conn->error);
        }

        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user'] = $user;
            $_SESSION['message'] = "✅ ورود با موفقیت انجام شد!";
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "<h3 style='color:red;'>❌ نام کاربری یا رمز عبور اشتباه است</h3>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<html lang="fa">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            background-color: #6996ae;
            font-family: tahoma;
            direction: rtl;
            text-align: center;
            margin: 150px;
        }
        .form { margin: 80px; }
        img { margin: 10px 0; border: 1px solid #000; }
    </style>
</head>
<body>

<?php if(isset($message)) echo $message; ?>

<form class="form" method="POST" action="">
    <label>نام کاربری</label><br>
    <input type="text" name="user_name" required><br>

    <label>رمز عبور</label><br>
    <input type="password" name="pas" required><br>

    <label>کد امنیتی</label><br>
    <img src="captcha.php" alt="captcha"><br>
    <input type="text" name="captcha" required><br>

    <input type="submit" value="ورود"><br>
</form>
</body>
</html>
