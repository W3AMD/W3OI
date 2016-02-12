<?php
//copyright LVARC W3OI
//Author: Igor Kasriel KC3ASC and John Borchers W3AMD
include('../includes/corefuncs.inc.php');
include('../includes/connection.inc.php');
if (function_exists('nukeMagicQuotes')) {
	nukeMagicQuotes();
	}
$conn = dbConnect();
$currdate = date("Y-m-d", time());
$sql = 'SELECT description FROM announcements WHERE startdate <= "'.$currdate.'" and enddate >= "'.$currdate.'" and active = "1" ORDER BY displayorder, enddate';
//$result = mysql_query( $sql ) or die ( mysql_error() );
$oldphp = getdbVersion();
if($oldphp)
{
   $result = mysql_query($sql) or die(mysql_error());
}
else
{
   $result = mysqli_query($conn, $sql) or die(mysqli_error());
}
$strReturn = '';
while (($oldphp)? $row = mysql_fetch_assoc($result)
      : $row = mysqli_fetch_assoc($result)) {
	$strReturn .= '<p>'.$row['description'].'</p>';
}
$strReturn .= '';

print($strReturn);
//print($sql);

?>
