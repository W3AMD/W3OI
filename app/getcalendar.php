<?php
require_once "includes/partials/_header.php";
set_include_path(get_include_path() . '/google-api-php-client/src');

$client_id = 'xxxx.apps.googleusercontent.com';
$service_account = 'xxxx@developer.gserviceaccount.com';
$p12 = 'xxxx-privatekey.p12';

session_start();
require_once 'Google/Client.php';
require_once 'Google/Service/Calendar.php';

$client = new Google_Client();
$client->setApplicationName("Calendrier");

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
}
?>
