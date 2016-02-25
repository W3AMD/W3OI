<?php
echo 'start session<br>';
session_start();
echo 'autoload<br>';
require_once '../googleapi/src/Google/autoload.php';
echo 'client<br>';
require_once '../googleapi/src/Google/Client.php';
echo 'calendar<br>';
require_once '../googleapi/src/Google/Service/Calendar.php';


$client_id = '100246733343874029792';
$Email_address = 'calanderservice@w3oi-1231.iam.gserviceaccount.com';
echo 'create google client<br>';
$client = new Google_Client();
echo 'set application name<br>';
$client->setApplicationName("Client_Calendar");
echo 'load key file<br>';
try
{
   $client->setAuthConfigFile('client_secret.json');
}
catch(Google_Exception$e)
{
   echo 'Goog says: ' . $e;
}
echo 'create client<br>';
$client = new Google_Client();
echo 'set app name<br>';
$client->setApplicationName("W3OICalender");
//$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
echo 'check session<br>';

if(isset($_SESSION['token']))
{
   echo 'success with token<BR>';
   $client->setAccessToken($_SESSION['token']);
}
$key = file_get_contents('client_secret.json');
$client->setClientId($client_id);
echo 'check authorization<br>';
$cred = new Google_Auth_AssertionCredentials(
$service_account,
array('https://www.googleapis.com/auth/calendar'),
$key);
echo 'assert creds<br>';
$client->setAssertionCredentials($cred);
if($client->getAuth()->isAccessTokenExpired())
{
   echo 'expired<br>';
   $client->getAuth()->refreshTokenWithAssertion($cred);
}
/*
$_SESSION['service_token'] = $client->getAccessToken();
$cal = new Google_Service_Calendar($client);
$events = $cal->calendarList->listCalendarList();
echo "<pre>";
print_r($events);
echo"</pre>";

while(true) {
foreach ($events->getItems() as $event) {
echo $event->getSummary();
print_r($event);
}
$pageToken = $events->getNextPageToken();
if ($pageToken) {
$optParams = array('pageToken' => $pageToken);
$events = $service->calendarList->listCalendarList($optParams);
} else {
break;
}
} */
?>