<?php
include('includes/corefuncs.inc.php');
include('../includes/sqlfunctions.inc.php');
include('../includes/connection.inc.php');

$id = $_POST['id'];

$currtime = date("Y-m-d H:i:s", time());

if (function_exists('nukeMagicQuotes')) {
	nukeMagicQuotes();
	}
$conn = dbConnect();

$sql  = 'UPDATE announcements SET active = "0", updated = "'.$currtime.'" WHERE id = "'.$id.'"';

$result = _mysql_query( $conn, $sql );

die($result);
//die($sql.' '.$currtime);

?>
