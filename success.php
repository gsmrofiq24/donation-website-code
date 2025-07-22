<?php
// Optional: আপনি চাইলে ট্রানজেকশন তথ্য আবার ডেটাবেজ থেকে এনে দেখতে পারেন

$trx_id = isset($_GET['trx_id']) ? htmlspecialchars($_GET['trx_id']) : 'N/A';
$amount = isset($_GET['amount']) ? htmlspecialchars($_GET['amount']) : 'N/A';
?>
<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>অনুদান সফল</title>
  <style>
    body {
      font-family: 'Noto Sans Bengali', sans-serif;
      background-color: #f0fff5;
      text-align: center;
      padding: 40px;
    }
    .card {
      background: white;
      max-width: 400px;
      margin: 0 auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .success {
      font-size: 48px;
      color: green;
      margin-bottom: 20px;
    }
    .info {
      font-size: 18px;
      margin-top: 10px;
    }
    .btn {
      display: inline-block;
      margin-top: 20px;
      background: #28a745;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="card">
  <div class="success">✅</div>
  <h2>ধন্যবাদ!</h2>
  <p>আপনার অনুদান সফলভাবে সম্পন্ন হয়েছে।</p>
  <div class="info">
    <strong>ট্রানজেকশন আইডি:</strong> <?php echo $trx_id; ?><br>
    <strong>পরিমাণ:</strong> ৳<?php echo $amount; ?>
  </div>
  <a href="/" class="btn">মূল পেইজে ফিরে যান</a>
</div>

</body>
</html>