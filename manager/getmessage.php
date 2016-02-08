<?php
include('includes/corefuncs.inc.php');
include('includes/adminconnection.inc.php');

//$id = $_POST['id'];
$id = $_GET['id'];

if (function_exists('nukeMagicQuotes')) {
	nukeMagicQuotes();
	}
$conn = dbConnect();
$sql = 'SELECT * FROM announcements WHERE id = "'.$id.'"';
$result = mysqli_query( $conn, $sql ) or die ( mysql_error() );
$strReturn = array();
while ( $row = mysqli_fetch_assoc( $result ) ) {
	$strReturn['id'] = $row['id'];
	$strReturn['description'] = $row['description'];
	$strReturn['startdate'] = $row['startdate'];
	$strReturn['enddate'] = $row['enddate'];
	$strReturn['displayorder'] = $row['displayorder'];
}

// encode array $strReturn to JSON string
$encoded = json_encode($strReturn);
 
// send response back to index.html
// and end script execution
die($encoded);

?>
