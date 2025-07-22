function sendDonationEmail($to_email, $to_name, $amount, $trxID) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'mail.topwin24.xyz';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@topwin24.xyz';
        $mail->Password   = 'gsm@2580';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->CharSet    = 'UTF-8';

        // Recipients
        $mail->setFrom('support@topwin24.xyz', 'টপউইন অনুদান পোর্টাল');
        $mail->addAddress($to_email, $to_name); // ডোনার

        // ✅ Admin Notification
        $mail->addBCC('tanhacomputer1@gmail.com', 'Admin Notification');

        // Content
        $mail->isHTML(true);
        $mail->Subject = '✅ অনুদান সফল হয়েছে';
        $mail->Body    = "
        <div style='font-family: Noto Sans Bengali, Kalpurush, sans-serif; font-size: 16px; line-height: 1.6; color: #333;'>
            <h2 style='color: green;'>🎉 ধন্যবাদ, $to_name!</h2>
            <p>আপনার অনুদান সফলভাবে গ্রহণ করা হয়েছে। নিচে আপনার ট্রানজেকশন তথ্য:</p>
            <ul>
                <li><strong>ট্রানজেকশন আইডি:</strong> $trxID</li>
                <li><strong>পরিমাণ:</strong> $amount ৳</li>
                <li><strong>ইমেইল:</strong> $to_email</li>
            </ul>
            <p>আপনার মহানুভবতার জন্য আমরা কৃতজ্ঞ।</p>
            <br>
            <p>শুভেচ্ছান্তে,<br><strong>টপউইন টিম</strong></p>
        </div>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}