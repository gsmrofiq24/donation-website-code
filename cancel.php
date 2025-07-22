<?php
// cancel.php
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>❌ অনুদান বাতিল</title>
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            background-color: #fff3cd;
            color: #856404;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .box {
            background: #ffffff;
            border: 1px solid #ffeeba;
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
            color: #d39e00;
        }
        p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background: #ffc107;
            color: #000;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
        }
        a:hover {
            background: #e0a800;
        }
    </style>
</head>
<body>
<div class="box">
    <h2>❌ অনুদান বাতিল করা হয়েছে</h2>
    <p>আপনি পেমেন্ট প্রক্রিয়াটি সম্পূর্ণ করেননি। দয়া করে পুনরায় চেষ্টা করুন।</p>
    <a href="/">🔁 আবার অনুদান দিন</a>
</div>
</body>
</html>