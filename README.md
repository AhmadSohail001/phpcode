<?php
session_start();

// بررسی setup
if (!isset($_SESSION['player1'], $_SESSION['player2'], $_SESSION['treasure1'], $_SESSION['treasure2'])) {
    header("Location: setup.php");
    exit();
}

$max_attempts = 3; // حداکثر شانس هر بازیکن
$message = "";

// پردازش حدس بازیکن
if (!isset($_SESSION['found']) && isset($_POST['cell'])) {
    $guess = (int)$_POST['cell'];

    if ($_SESSION['turn'] == 1 && $_SESSION['attempts1'] < $max_attempts) {
        $_SESSION['attempts1']++;
        if ($guess === $_SESSION['treasure2']) {
            $message = "🎉 تبریک " . $_SESSION['player1'] . "! گنج " . $_SESSION['player2'] . " را پیدا کردی در تلاش شماره " . $_SESSION['attempts1'];
            $_SESSION['found'] = 1;
        } else {
            $message = "❌ حدس اشتباه " . $_SESSION['player1'];
            $_SESSION['turn'] = 2; // نوبت نفر بعد
        }
    } elseif ($_SESSION['turn'] == 2 && $_SESSION['attempts2'] < $max_attempts) {
        $_SESSION['attempts2']++;
        if ($guess === $_SESSION['treasure1']) {
            $message = "🎉 تبریک " . $_SESSION['player2'] . "! گنج " . $_SESSION['player1'] . " را پیدا کردی در تلاش شماره " . $_SESSION['attempts2'];
            $_SESSION['found'] = 2;
        } else {
            $message = "❌ حدس اشتباه " . $_SESSION['player2'];
            $_SESSION['turn'] = 1; // نوبت نفر بعد
        }
    }

    // اگر شانس هر دو تمام شد و کسی پیدا نکرد
    if ($_SESSION['attempts1'] >= $max_attempts && $_SESSION['attempts2'] >= $max_attempts && !isset($_SESSION['found'])) {
        $message = "⚠️ بازی تمام شد! هیچ کس گنج را پیدا نکرد.";
        $_SESSION['found'] = 0;
    }
}

// ریست بازی
if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: setup.php");
    exit();
}

// تعیین رنگ نوبت و شانس باقی مانده
$current_player = $_SESSION['turn'] == 1 ? $_SESSION['player1'] : $_SESSION['player2'];
$current_color = $_SESSION['turn'] == 1 ? "#00ff99" : "#ff595e";
$attempts_left = $_SESSION['turn'] == 1 ? $max_attempts - $_SESSION['attempts1'] : $max_attempts - $_SESSION['attempts2'];

$show_grid = (!isset($_SESSION['found']) || $_SESSION['found'] === false) && $attempts_left > 0;
$show_reset = isset($_SESSION['found']) || (!$show_grid && !$show_grid);

$gridSize = 3; // جدول ۳x۳
?>

<!DOCTYPE html>
<html>
<head>
    <title>بازی پیدا کردن گنج</title>
    <style>
        body { font-family: 'Press Start 2P', cursive; background: linear-gradient(135deg,#1a1a2e,#162447); color:#fff; text-align:center; padding-top:50px; }
        h1 { color:#ffd700; font-size:36px; text-shadow:0 0 10px #ffd700,0 0 20px #ffb800; }
        .message { font-size:18px; margin:20px; color:#00ffcc; }
        .turn { font-size:20px; margin:15px; font-weight:bold; }
        .grid { display:inline-grid; grid-template-columns:repeat(3,80px); gap:10px; margin-top:20px; }
        .grid button { width:80px; height:80px; font-size:24px; font-weight:bold; background:#162447; color:#e0e0e0; border:2px solid #1f4068; border-radius:10px; cursor:pointer; transition:all 0.3s ease; }
        .grid button:hover { transform:scale(1.1); background:#1f4068; }
        .grid button:disabled { background:#555; cursor:not-allowed; }
        button.reset-btn { margin-top:20px; padding:12px 25px; font-size:16px; background:#ffd700; border:none; border-radius:8px; cursor:pointer; font-weight:bold; transition:0.3s; }
        button.reset-btn:hover { background:#e6c200; transform:scale(1.05); }
    </style>
</head>
<body>
    <h1>💎 بازی پیدا کردن گنج 💎</h1>

    <div class="message"><?php echo $message; ?></div>

    <?php if ($show_grid): ?>
        <div class="turn" style="color: <?php echo $current_color; ?>">
            نوبت: <?php echo $current_player; ?> | شانس باقیمانده: <?php echo $attempts_left; ?>
        </div>
        <form method="post">
            <div class="grid">
                <?php
                for ($i=1; $i <= $gridSize*$gridSize; $i++) {
                    echo "<button type='submit' name='cell' value='$i'>$i</button>";
                }
                ?>
            </div>
        </form>
    <?php endif; ?>

    <?php if ($show_reset): ?>
        <form method="post">
            <button class="reset-btn" name="reset" type="submit">شروع مجدد بازی</button>
        </form>
    <?php endif; ?>
</body>
</html>
