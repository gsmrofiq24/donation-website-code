<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

require_once 'db.php';
$conn->set_charset("utf8mb4");

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID প্রদান করা হয়নি।");
}

// ডেটা ফেচ করুন
$stmt = $conn->prepare("SELECT * FROM donations WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$donor = $result->fetch_assoc();

if (!$donor) {
    die("ডোনার পাওয়া যায়নি।");
}

// আপডেট প্রক্রিয়া
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $mobile  = $_POST['mobile'];
    $email   = $_POST['email'];
    $amount  = $_POST['amount'];
    $status  = $_POST['status'];

    $stmt = $conn->prepare("UPDATE donations SET name=?, mobile=?, email=?, amount=?, status=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $mobile, $email, $amount, $status, $id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>✏️ ডোনার সম্পাদনা</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .form-box {
            background: #fff;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 15px;
        }
        label {
            font-weight: bold;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>✏️ ডোনার তথ্য সম্পাদনা করুন</h2>
    <form method="POST">
        <label>নাম</label>
        <input type="text" name="name" value="<?= htmlspecialchars($donor['name']) ?>" required>

        <label>মোবাইল</label>
        <input type="text" name="mobile" value="<?= htmlspecialchars($donor['mobile']) ?>" required>

        <label>ইমেইল</label>
        <input type="email" name="email" value="<?= htmlspecialchars($donor['email']) ?>" required>

        <label>পরিমাণ (৳)</label>
        <input type="number" step="0.01" name="amount" value="<?= htmlspecialchars($donor['amount']) ?>" required>

        <label>স্ট্যাটাস</label>
        <select name="status" required>
            <option value="Pending" <?= $donor['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Approved" <?= $donor['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
            <option value="Rejected" <?= $donor['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
        </select>

        <button type="submit">💾 আপডেট করুন</button>
    </form>

    <a href="admin_dashboard.php">⬅️ ফিরে যান</a>
</div>

</body>
</html>