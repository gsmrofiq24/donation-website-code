<?php
session_start();

// কাস্টম ইউজারনেম ও পাসওয়ার্ড (এখানে আপনি নিজের মতো করে দিন)
$admin_username = "admin";
$admin_password = "123456"; // চাইলে পরে হ্যাশ করে নিতে পারেন

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $_SESSION['login_error'] = "❌ ইউজারনেম বা পাসওয়ার্ড ভুল!";
        header("Location: admin_login.php");
        exit();
    }
} else {
    header("Location: admin_login.php");
    exit();
}