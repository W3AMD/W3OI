<?php
echo 'start session<br>';
session_start();
echo 'autoload<br>';
require_once '../googleapi/src/Google/autoload.php';
echo 'client<br>';
require_once '../googleapi/src/Google/Client.php';
echo 'calendar<br>';
require_once '../googleapi/src/Google/Service/Calendar.php';

echo 'create client<br>';

$client = new Google_Client();
echo 'load key file<br>';
try {
$client->setAuthConfigFile('client_secret.json');
}
catch (Google_Exception $e) {
echo 'Goog says: ' . $e;
}
/*
//$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

$client = new Google_Client();
$client->setApplicationName("W3OICalender");
*/
/*
if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

$key = file_get_contents($p12);
$client->setClientId($client_id);
$cred = new Google_Auth_AssertionCredentials(
    $service_account,
    array('https://www.googleapis.com/auth/calendar'),
    $key);

$client->setAssertionCredentials($cred);
if($client->getAuth()->isAccessTokenExpired()) {
  $client->getAuth()->refreshTokenWithAssertion($cred);
}
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
