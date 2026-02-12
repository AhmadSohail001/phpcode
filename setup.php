<?php
session_start();

// اگر هر دو بازیکن ثبت شده‌اند، مستقیم به بازی بفرست
if (isset($_SESSION['player1'], $_SESSION['player2'], $_SESSION['treasure1'], $_SESSION['treasure2'])) {
    header("Location: game.php");
    exit();
}

// پردازش فرم
if (isset($_POST['player'], $_POST['treasure'])) {
    $player_name = htmlspecialchars($_POST['player']);
    $treasure = (int)$_POST['treasure'];

    // بازیکن 1 ثبت نشده
    if (!isset($_SESSION['player1'])) {
        $_SESSION['player1'] = $player_name;
        $_SESSION['treasure1'] = $treasure;
        $_SESSION['attempts1'] = 0;
        header("Location: setup.php");
        exit();
    }
    // بازیکن 2 ثبت نشده
    elseif (!isset($_SESSION['player2'])) {
        $_SESSION['player2'] = $player_name;
        $_SESSION['treasure2'] = $treasure;
        $_SESSION['attempts2'] = 0;
        $_SESSION['turn'] = 1;
        header("Location: game.php");
        exit();
    }
}

// تعیین نوبت فعلی
if (!isset($_SESSION['player1'])) {
    $current_player = 1;
    $color = "#00ff99";
} elseif (!isset($_SESSION['player2'])) {
    $current_player = 2;
    $color = "#ff595e";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Setup فانتزی بازی گنج</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
        body {
            font-family:'Press Start 2P', cursive;
            background: linear-gradient(135deg,#1a1a2e,#162447);
            color:#fff;
            text-align:center;
            padding-top:50px;
        }
        h1 {
            font-size:36px;
            text-shadow: 0 0 10px #ffd700,0 0 20px #ffb800;
            color: <?php echo $color; ?>;
            animation: glow 1.5s infinite alternate;
        }
        @keyframes glow {
            0% { text-shadow: 0 0 5px <?php echo $color; ?>; }
            100% { text-shadow: 0 0 25px <?php echo $color; ?>; }
        }
        form {
            background: rgba(0,0,0,0.75);
            display:inline-block;
            padding:30px;
            border-radius:20px;
            box-shadow: 0 0 25px <?php echo $color; ?>;
        }
        input {
            padding:10px;
            font-size:16px;
            margin:10px;
            border-radius:8px;
            border:none;
            text-align:center;
        }
        input[type=number] { width:80px; }
        button {
            padding:15px 35px;
            font-size:18px;
            background: <?php echo $color; ?>;
            border:none;
            border-radius:12px;
            cursor:pointer;
            font-weight:bold;
            color:#000;
            transition:0.3s;
        }
        button:hover { background: #fff; transform: scale(1.05); color: <?php echo $color; ?>; }
        p { margin:10px; font-size:14px; }
    </style>
</head>
<body>
    <h1>💎 ثبت نام بازیکن <?php echo $current_player; ?> 💎</h1>
    <form method="post">
        <p>نام بازیکن <?php echo $current_player; ?>:</p>
        <input type="text" name="player" required placeholder="اسم خود را وارد کنید">

        <p>خانه گنج بازیکن <?php echo $current_player; ?> (1-9):</p>
        <input type="number" name="treasure" min="1" max="9" required>

        <br><br>
        <button type="submit">ثبت</button>
    </form>
</body>
</html>
