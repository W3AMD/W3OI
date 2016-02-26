<?php
include('includes/corefuncs.inc.php');
include('../includes/sqlfunctions.inc.php');
include('../includes/connection.inc.php');

//$id = $_POST['id'];
$id = $_GET['id'];

if (function_exists('nukeMagicQuotes')) {
	nukeMagicQuotes();
	}
$conn = dbConnect();
$sql = 'SELECT * FROM announcements WHERE id = "'.$id.'"';
$result = _mysql_query( $conn, $sql );
$strReturn = array();
while ( $row = _mysql_fetch_assoc( $conn, $result ) ) {
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
