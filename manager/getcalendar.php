<?php
echo 'start session<br>';
session_start();
echo 'autoload<br>';
require_once '../googleapi/src/Google/autoload.php';
echo 'client<br>';
require_once '../googleapi/src/Google/Client.php';
echo 'calendar<br>';
require_once '../googleapi/src/Google/Service/Calendar.php';
 //password notasecret

try {
$client_id = 'c48bee008e4ad0cdd9b7b2b36cc23c4847fd4f4f';
$client_email = 'calanderservice@w3oi-1231.iam.gserviceaccount.com';
$private_key = file_get_contents('w3oicalendar.p12');
$scopes = array('https://www.googleapis.com/auth/sqlservice.admin');
$credentials = new Google_Auth_AssertionCredentials(
    $client_email,
    $scopes,
    $private_key
);
$client = new Google_Client();
$client->setAssertionCredentials($credentials);
if ($client->getAuth()->isAccessTokenExpired()) {
  $client->getAuth()->refreshTokenWithAssertion();
}
}
catch (exception $e) {
echo $e;
}
?>