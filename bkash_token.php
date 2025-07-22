<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$URL = "https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/token/grant";

$headers = [
    "Content-Type: application/json",
    "username: 01810794157",
    "password: =wSd0z7?Uzf"
];

$body = json_encode([
    'app_key' => "Z9YviKKL6S8xMDMZNXe89bUZtc",
    'app_secret' => "9di6mVkVP5khpBIPBDHBisCoQTsMNkHZf4qbfXQ0UWukWp9GropJ"
]);

$ch = curl_init($URL);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // যদি SSL verification সমস্যা হয়

$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    echo $result;
}

curl_close($ch);