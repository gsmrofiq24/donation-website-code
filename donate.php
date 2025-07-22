<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['name'];
    $mobile  = $_POST['mobile'];
    $email   = $_POST['email'];
    $amount  = $_POST['amount'];
    $message = $_POST['message'];

    $invoice = "DONATE2025_" . time();

    // ✅ local path use
    // ✅ CURL দিয়ে bkash_token.php রান করে JSON পাওয়া
$ch = curl_init("https://job.topwin24.xyz/bkash/bkash_token.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$token_json = curl_exec($ch);
curl_close($ch);

$token_data = json_decode($token_json, true);

if (!isset($token_data['id_token'])) {
    echo "<pre>"; print_r($token_data); echo "</pre>";
    die("❌ bKash token রেসপন্স সঠিক নয়।");
}

$token = $token_data['id_token'];

    $create_url = "https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/create";
    $headers = [
        "Content-Type: application/json",
        "Authorization: $token",
        "X-APP-Key: Z9YviKKL6S8xMDMZNXe89bUZtc"
    ];

    $payment_data = [
        "mode" => "0011",
        "payerReference" => $mobile,
        "callbackURL" => "https://job.topwin24.xyz/bkash/bkash_execute_payment.php",
        "amount" => number_format($amount, 2, '.', ''),
        "currency" => "BDT",
        "intent" => "sale",
        "merchantInvoiceNumber" => $invoice
    ];

    $ch = curl_init($create_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payment_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);

    if (isset($response['bkashURL'])) {
        session_start();
        $_SESSION['form_data'] = compact('name', 'mobile', 'email', 'amount', 'message', 'invoice');
        header("Location: " . $response['bkashURL']);
        exit;
    } else {
        echo "bKash পেমেন্ট শুরু করা যায়নি। দয়া করে পরে আবার চেষ্টা করুন।";
    }
}
?>