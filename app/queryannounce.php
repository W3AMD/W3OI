<?php
//copyright LVARC W3OI
//Author: Igor Kasriel KC3ASC and John Borchers W3AMD
include ('../includes/sqlfunctions.inc.php');
include('../includes/corefuncs.inc.php');
include('../includes/connection.inc.php');
if (function_exists('nukeMagicQuotes')) {
	nukeMagicQuotes();
	}
$conn = dbConnect();
$currdate = date("Y-m-d", time());
$sql = 'SELECT description FROM announcements WHERE startdate <= "'.$currdate.
'" and enddate >= "'.$currdate.'" and active = "1" ORDER BY displayorder, enddate';
$result = _mysql_query($conn,$sql);
$strReturn = '';
$count=0;
while ($row = _mysql_fetch_assoc($conn,$result)) {
	$count++;
	$strReturn .= '<p><h2>'.$row['description'].'</h2><hr/></p>';
}
if($count==0) {
 echo 'No Announcements at this time.';
 }
$strReturn .= '';
print($strReturn);
?>
