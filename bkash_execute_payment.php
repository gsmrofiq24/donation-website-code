<?php
// Step 0: Cancel check
if (isset($_GET['status']) && $_GET['status'] === 'cancel') {
    header("Location: /cancel.php");
    exit();
}

// Step 0.5: Show full errors (for debug — remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../db.php';
session_start();

// Step 1: Validate paymentID
if (!isset($_GET['paymentID'])) {
    die("❌ Invalid access: paymentID missing");
}

$paymentID = $_GET['paymentID'];

// Step 2: Get bKash token
$ch = curl_init("https://job.topwin24.xyz/bkash/bkash_token.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$token_json = curl_exec($ch);
curl_close($ch);

$token_data = json_decode($token_json, true);

if (!isset($token_data['id_token'])) {
    header("Location: /error.php");
    exit();
}

$token = $token_data['id_token'];

// Step 3: Execute payment with bKash
$execute_url = "https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/checkout/execute";
$headers = [
    "Content-Type: application/json",
    "Authorization: $token",
    "X-APP-Key: Z9YviKKL6S8xMDMZNXe89bUZtc"
];

$post_data = json_encode(['paymentID' => $paymentID]);

$ch = curl_init($execute_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result, true);

// Step 4: Validate bKash success
if (isset($response['transactionStatus']) && $response['transactionStatus'] === 'Completed') {
    $trxID = $response['trxID'] ?? '';
    $amount = $response['amount'] ?? '0.00';

    // Save donation info from session
    if (isset($_SESSION['form_data'])) {
        $data = $_SESSION['form_data'];

        $stmt = $conn->prepare("INSERT INTO donations (name, mobile, email, amount, message, trx_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdss", $data['name'], $data['mobile'], $data['email'], $data['amount'], $data['message'], $trxID);
        $stmt->execute();
        $stmt->close();
    

        // Clear session data after successful insert
        unset($_SESSION['form_data']);
    }

    // Redirect to success page
    header("Location: /success.php?trx_id=$trxID&amount=$amount");
    exit();

} else {
    // If execution failed
    header("Location: /error.php");
    exit();
}
?>