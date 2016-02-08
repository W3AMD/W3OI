<?php
include('../includes/corefuncs.inc.php');
include('../includes/connection.inc.php');
if (function_exists('nukeMagicQuotes')) {
	nukeMagicQuotes();
	}
$conn = dbConnect();
$currdate = date("Y-m-d", time());
$sql = 'SELECT description FROM announcements WHERE startdate <= "'.$currdate.'" and enddate >= "'.$currdate.'" and active = "1" ORDER BY displayorder, enddate';
//$result = mysql_query( $sql ) or die ( mysql_error() );
$result = mysqli_query( $conn, $sql ) or die ( mysqli_error($conn) );
$strReturn = '';
//while ( $row = mysql_fetch_assoc( $result ) ) {
while ( $row = mysqli_fetch_assoc( $result ) ) {
	$strReturn .= '<p>'.$row['description'].'</p>';
}
$strReturn .= '';

print($strReturn);
//print($sql);

?>
