<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
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
        .dashboard { margin: 80px; }
    </style>
</head>
<body>
    <div class="dashboard">
        <?php
        if(isset($_SESSION['message'])) {
            echo "<h3 style='color:green;'>".$_SESSION['message']."</h3>";
            unset($_SESSION['message']);
        }
        ?>

        <h2>خوش آمدید <?php echo htmlspecialchars($_SESSION['user']['user_name']); ?>!</h2>

        <p>نام کاربری: <?php echo htmlspecialchars($_SESSION['user']['user_name']); ?></p>
        <p>رمز عبور: <?php echo htmlspecialchars($_SESSION['user']['pas']); ?></p>

        <a href="logout.php">خروج</a>
    </div>
</body>
</html>
