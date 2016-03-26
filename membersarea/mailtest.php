<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
// multiple recipients
$to  = 'kc3ase@gmail.com';

// subject
$subject = 'Test W3OI PHP Mail';

// message
$message = 'This is a test message sent from the W3OI web server to see if your email provider will block this email as s p a m. If this email is blocked as spam please let me know or if you\'ve received it successfully.';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$headers = 'From: W3OI <server@w3oi.org>' . "\r\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>
</body>
</html>