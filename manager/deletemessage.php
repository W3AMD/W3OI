<?php
include('includes/corefuncs.inc.php');
include('includes/adminconnection.inc.php');

$id = $_POST['id'];

$currtime = date("Y-m-d H:i:s", time());

if (function_exists('nukeMagicQuotes')) {
	nukeMagicQuotes();
	}
$conn = dbConnect();

$sql  = 'UPDATE announcements SET active = "0", updated = "'.$currtime.'" WHERE id = "'.$id.'"';

$result = mysqli_query( $conn, $sql ) or die ( mysql_error( $conn ) );

die($result);
//die($sql.' '.$currtime);

?>
