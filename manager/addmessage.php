<?php
include('includes/corefuncs.inc.php');
include('../includes/sqlfunctions.inc.php');
include('includes/adminconnection.inc.php');

$id = $_POST['id'];
$description = $_POST['description'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$displayorder = $_POST['displayorder'];
$action = $_POST['action'];

$currtime = date("Y-m-d H:i:s", time());
if (function_exists('nukeMagicQuotes')) {
	nukeMagicQuotes();
	}
$conn = dbConnect();

if ($action=='add')
{
	$sql  = 'INSERT INTO announcements (description, displayorder, startdate, enddate, active, created, updated) values (';
	$sql .= "'".$description."','".$displayorder."','".$startdate."','".$enddate."','".'1'."','".$currtime."','".$currtime."')";
}
else if ($action=='edit')
{
	$sql  = 'UPDATE announcements ';
	$sql .= "SET description = '".$description."', displayorder = '".$displayorder."', startdate = '".$startdate."', enddate = '".$enddate."', updated = '".$currtime."' ";
	$sql .= "WHERE id = '".$id."'";
}
else
{
	die('Unknown action: '.$action);
}

$result = _mysql_query( $conn, $sql );

die($result);
//die($sql.' '.$currtime);

?>
