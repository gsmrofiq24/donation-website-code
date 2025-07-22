<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>অনুদান করুন</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'SolaimanLipi', Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .form-container {
            background: #fff;
            max-width: 500px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ddd;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #0099FF;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background: #007acc;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>💝 অনুদান ফর্ম</h2>
        <form action="donate.php" method="POST">
            <input type="text" name="name" placeholder="আপনার নাম" required>
            <input type="text" name="mobile" placeholder="মোবাইল নম্বর" required>
            <input type="email" name="email" placeholder="ইমেইল" required>
            <input type="number" name="amount" placeholder="অনুদানের পরিমাণ (৳)" required>
            <textarea name="message" placeholder="বার্তা (ঐচ্ছিক)"></textarea>
            <button type="submit">➡️ অনুদান দিন</button>
        </form>
    </div>
</body>
</html>