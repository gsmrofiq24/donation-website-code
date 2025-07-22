<?php
// ডাটাবেস কানেকশন
$conn = new mysqli("localhost", "topwinx1_donation", "topwinx1_donation", "topwinx1_donation");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// মোট অনুদান পরিমাণ
$totalAmountResult = $conn->query("SELECT SUM(amount) as total FROM donations");
$totalAmount = $totalAmountResult->fetch_assoc()['total'] ?? 0;

// মোট ডোনার সংখ্যা (ইউনিক মোবাইল দিয়ে ধরা হলো)
$donorCountResult = $conn->query("SELECT COUNT(DISTINCT mobile) as donors FROM donations");
$totalDonors = $donorCountResult->fetch_assoc()['donors'] ?? 0;
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>অনুদান হোমপেইজ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'SolaimanLipi', Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .hero {
            background: linear-gradient(120deg, #0099FF, #00cc99);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .hero p {
            font-size: 18px;
            margin-top: 0;
        }

        .stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            background: #ffffff;
            padding: 30px 20px;
            margin-top: -20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .stat-box {
            text-align: center;
        }
        .stat-box h2 {
            color: #0099FF;
            font-size: 28px;
            margin-bottom: 5px;
        }
        .stat-box p {
            color: #555;
            font-size: 14px;
        }

        .section {
            padding: 30px 20px;
            max-width: 900px;
            margin: auto;
            background: #fff;
            margin-top: 20px;
            border-radius: 10px;
        }

        .testimonial {
            background: #e0f7fa;
            padding: 20px;
            border-left: 5px solid #00acc1;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .donate-button {
            display: block;
            width: fit-content;
            margin: 30px auto;
            background: #0099FF;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 18px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .donate-button:hover {
            background: #007acc;
        }
    </style>
</head>
<body>

    <!-- 🔷 Hero Section -->
    <div class="hero">
        <h1>💖 আপনার অনুদানে বদলে যেতে পারে একটি জীবন</h1>
        <p>নিরাপদ, দ্রুত ও সহজ অনুদান – এক ক্লিকে করুন মানুষের পাশে দাঁড়ানোর অঙ্গীকার।</p>
        <a class="donate-button" href="donation_form.php">➡️ অনুদান দিন</a>
    </div>

<!-- 📊 Stats Section (Dynamic) -->
<div class="stats">
    <div class="stat-box">
        <h2>৳ <?php echo number_format($totalAmount); ?></h2>
        <p>মোট অনুদান</p>
    </div>
    <div class="stat-box">
        <h2><?php echo $totalDonors; ?>+</h2>
        <p>ডোনার</p>
    </div>
    <div class="stat-box">
        <h2>১২টি</h2> <!-- চাইলে এটাও ডাটাবেজ থেকে নিতে পারেন -->
        <p>সেবা প্রাপ্ত পরিবার</p>
    </div>
</div>

    <!-- 🤝 Mission Section -->
    <div class="section">
        <h2>আমাদের লক্ষ্য</h2>
        <p>আমরা বিশ্বাস করি যে সমাজে সবার পাশে থাকা, বিশেষত দুস্থ ও অসহায় মানুষের পাশে দাঁড়ানো আমাদের দায়িত্ব। এই প্ল্যাটফর্মের মাধ্যমে আমরা সেই সেতু গড়ে তুলছি — আপনার সাহায্য পৌঁছে যাচ্ছে সঠিক হাতে।</p>
    </div>

    <!-- 💬 Testimonials -->
    <div class="section">
        <h2>🌟 ডোনারদের মতামত</h2>

        <div class="testimonial">
            “অনলাইনে এত সহজ ও সুন্দরভাবে অনুদান দিতে পারবো ভাবিনি। ধন্যবাদ টপউইন টিমকে!” – <strong>সোহেল রানা</strong>
        </div>

        <div class="testimonial">
            “আমি চাই সব মানুষ এই প্ল্যাটফর্ম ব্যবহার করে সমাজের জন্য কিছু করুক।” – <strong>মাহমুদা নাসরিন</strong>
        </div>
    </div>

</body>
</html>