<?php
echo 'start session<br>';
session_start();
echo 'autoload<br>';
require_once '../googleapi/src/Google/autoload.php';
echo 'client<br>';
require_once '../googleapi/src/Google/Client.php';
echo 'calendar<br>';
require_once '../googleapi/src/Google/Service/Calendar.php';

try
{
   $client_email = 'calanderservice@w3oi-1231.iam.gserviceaccount.com';
   $private_key = file_get_contents('w3oicalendar.p12');
   $password = 'notasecret';
   $scopes = array('https://www.googleapis.com/auth/calendar',
    'https://www.googleapis.com/auth/calendar.readonly');
   $credentials = new Google_Auth_AssertionCredentials(
   $client_email,$scopes,$private_key,$password);
   $client = new Google_Client();
   $client->setAssertionCredentials($credentials);
   if($client->getAuth()->isAccessTokenExpired())
   {
      $client->getAuth()->refreshTokenWithAssertion();
   }
}
catch(exception$e)
{
   echo $e;
}
?>