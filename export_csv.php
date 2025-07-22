<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

require_once 'db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=donations.csv');

$output = fopen("php://output", "w");
fputcsv($output, ['নাম', 'মোবাইল', 'ইমেইল', 'পরিমাণ', 'মেসেজ', 'TrxID', 'সময়']);

$result = $conn->query("SELECT * FROM donations ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['name'],
        $row['mobile'],
        $row['email'],
        $row['amount'],
        $row['message'],
        $row['trx_id'],
        $row['created_at']
    ]);
}
fclose($output);
exit;