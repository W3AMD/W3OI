<?php require_once('../Connections/W3OITesting.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_W3OITesting, $W3OITesting);
$query_W3OITestRecords = "SELECT * FROM members";
$W3OITestRecords = mysql_query($query_W3OITestRecords, $W3OITesting) or die(mysql_error());
$row_W3OITestRecords = mysql_fetch_assoc($W3OITestRecords);
$totalRows_W3OITestRecords = mysql_num_rows($W3OITestRecords);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php do { ?>
  <p><?php echo $row_W3OITestRecords['lname']; ?> </p>
  <?php } while ($row_W3OITestRecords = mysql_fetch_assoc($W3OITestRecords)); ?>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($W3OITestRecords);
?>
