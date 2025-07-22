<?php
if (!isset($_GET['paymentID'])) {
    die("পেমেন্ট আইডি পাওয়া যায়নি।");
}

$paymentID = $_GET['paymentID'];

// Step 1: Token তৈরি করা
$token_data = file_get_contents("bkash_token.php");
$token = json_decode($token_data, true)['id_token'];

$query_url = "https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/payment/status?paymentID=$paymentID";
$headers = [
    "Content-Type: application/json",
    "Authorization: $token",
    "X-APP-Key: Z9YviKKL6S8xMDMZNXe89bUZtc"
];

$ch = curl_init($query_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,