<?php
// error.php
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>❌ পেমেন্ট ব্যর্থ</title>
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            background-color: #f8d7da;
            color: #721c24;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .box {
            background: #ffffff;
            border: 1px solid #f5c6cb;
            padding: 30px 20px;
            border-radius: 10px;
            text-align: center;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #c82333;
        }
        p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
        }
        a:hover {
            background: #bd2130;
        }
    </style>
</head>
<body>
<div class="box">
    <h2>❌ পেমেন্ট ব্যর্থ হয়েছে</h2>
    <p>আপনার পেমেন্ট প্রক্রিয়া সফল হয়নি। অনুগ্রহ করে কিছুক্ষণ পর আবার চেষ্টা করুন।</p>
    <a href="/">🔁 পুনরায় চেষ্টা করুন</a>
</div>
</body>
</html>