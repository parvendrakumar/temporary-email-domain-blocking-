<?php
// Function to detect temporary email domains
if (!function_exists('is_temp_email')) {
    function is_temp_email($email) {
        $temp_domains = [
            'claspira.com', 'tempmail.com', '10minutemail.com', 'mailinator.com', 'guerrillamail.com',
            'trashmail.com', 'yopmail.com', 'dispostable.com', 'getairmail.com', 'fakeinbox.com',
            'emailondeck.com', 'temp-mail.org', 'mytemp.email', 'mintemail.com', 'maildrop.cc',
            'throwawaymail.com', 'mailcatch.com', 'inboxkitten.com', 'spamgourmet.com', 'moakt.com',
            'anonymbox.com', 'sharklasers.com', 'grr.la', 'tempinbox.com', 'spam4.me',
            'fakemailgenerator.com', 'emailtemporario.com.br', 'dodgit.com', 'nowmymail.com', 'no-spam.ws',
            'eyepaste.com', 'boun.cr', 'tempalias.com', 'nospamfor.us', 'discard.email', 'wegwerfmail.de',
            'mailnesia.com', 'easytrashmail.com', 'meltmail.com', '0wnd.net', 'mailhazard.com',
            'spamdecoy.net', 'kasmail.com', 'mailnull.com', 'mail-temp.com', 'smellfear.com',
            'spambox.info', 'spamavert.com', 'trash-mail.com', 'instantemailaddress.com', 'tempemail.co'
        ];

        $domain = strtolower(substr(strrchr($email, "@"), 1));
        return in_array($domain, $temp_domains);
    }
}

// Handle form submission
$email = "";
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<span style='color: red;'>Invalid email format.</span>";
    } elseif (is_temp_email($email)) {
        $message = "<span style='color: red;'>Temporary/disposable emails are not allowed.</span>";
    } else {
        $message = "<span style='color: green;'>Email is valid and accepted.</span>";
        // You can proceed with form logic like saving to DB or sending email
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Validator</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 40px; }
        .container { background: white; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; box-shadow: 0 0 10px #ccc; }
        input[type="email"], button { width: 100%; padding: 10px; margin-top: 10px; }
        .message { margin-top: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Check Email Validity</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Enter your email" value="<?= htmlspecialchars($email) ?>" required>
        <button type="submit">Submit</button>
    </form>
    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>
</div>

</body>
</html>
