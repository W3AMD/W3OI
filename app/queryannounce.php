<?php
echo $_SERVER['DOCUMENT_ROOT'] . 'queryannounce.php';
include('../includes/corefuncs.inc.php');
include('../includes/connection.inc.php');
if (function_exists('nukeMagicQuotes')) {
	nukeMagicQuotes();
	}
$conn = dbConnect();
$currdate = date("Y-m-d", time());
$sql = 'SELECT description FROM announcements WHERE startdate <= "'.$currdate.'" and enddate >= "'.$currdate.'" and active = "1" ORDER BY displayorder, enddate';
$result = _mysql_query($conn1,$sql);
$strReturn = '';
while ($row = _mysql_fetch_assoc($conn1,$result)) {
	$strReturn .= '<p>'.$row['description'].'</p>';
}
$strReturn .= '';
print($strReturn);
?>
