<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>🛡️ অ্যাডমিন লগইন</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            background-color: #f2f2f2;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 15px #ccc;
            width: 350px;
        }
        .login-box h2 {
            margin-bottom: 15px;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            background: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            font-size: 16px;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>🛡️ অ্যাডমিন লগইন</h2>

    <?php if (isset($_SESSION['login_error'])): ?>
        <div class="error"><?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
    <?php endif; ?>

    <form action="admin_auth.php" method="POST">
        <input type="text" name="username" placeholder="ইউজারনেম" required>
        <input type="password" name="password" placeholder="পাসওয়ার্ড" required>
        <button type="submit">🔐 লগইন</button>
    </form>
</div>

</body>
</html>