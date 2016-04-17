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
/*get members names, callsigns, email addresses where members are active at least within the last year */
//$yearnow = date("Y").'-12-31';
$yearrecent = date("Y",strtotime('-0 year')).'-12-31';
$query_Recordset1 = "SELECT DISTINCT lname, fname, suffix, fcccall, email, members.member_id, MaxDateTime " .
"FROM members " .
"INNER JOIN " .
    "(SELECT paid.member_id, MAX(paid.year) AS MaxDateTime " .
    "FROM paid " .
    "GROUP BY paid.member_id) groupedpaid ".
    "ON members.member_id = groupedpaid.member_id " .
"Where (MaxDateTime >= '$yearrecent') " .
"ORDER BY lname, fname, suffix, fcccall";
$Recordset1 = mysql_query($query_Recordset1, $W3OITesting) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/W3OIMemAreaNavTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bulk Email Listing</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- <link href="file:///C|/Users/John/Documents/HTML5 Builder/Projects/W3OI/css/bootstrap.css" rel="stylesheet" type="text/css"> -->
<link href="../css/bootstrap-3.3.6.css" rel="stylesheet" type="text/css">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body style="padding-top: 70px">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="http://www.w3oi.org">W3OI</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="topFixedNavbar1">
     <ul class="nav navbar-nav">
        <li class="inactive"><a href="membersarea.php">Members Area<span class="sr-only"></span></a></li>
        <li class="dropdown"><a href="membershipmanagerhome.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="presentation"><a href="activememberdatadump.php">Active Members Data File</a></li>
            <li role="presentation"><a href="bulkactiveemaillist.php">Recent Email List</a></li>
            <!--
            <li role="separator" class="divider"></li>
            <li><a href="sendofficersemail.php">Send Officers Email</a></li>
            <li><a href="sendboardemail.php">Send Board Email</a></li>
            <li><a href="sendofficersboardemail.php">Send Officers / Board Email</a></li>
            <li><a href="sendbulkclubemail.php">Send Bulk Club Email</a></li>
            -->
          </ul>
        </li>
     </ul>
    <form method="post" class="navbar-form navbar-left"
      action="memberinfo.php">
        <div class="form-group">
          <input type="text" class="form-control" name="Search" placeholder="Callsign or Lastname">
        </div>
        <button type="submit" class="btn btn-default" id="Submit" >Search</button>
        </a>
      </form>
      </div>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<script src="../js/jquery-1.11.3.min.js"></script>
<!-- <script src="file:///C|/Users/John/AppData/Roaming/Adobe/Dreamweaver CC 2015/en_US/Configuration/Temp/Assets/eam4A93.tmp/js/bootstrap.js"></script> -->
<script src="../js/bootstrap-3.3.6.js"></script>
<!-- InstanceBeginEditable name="EditRegion3" -->
<div class="container">
<?php 
do { 
$firstname=$row_Recordset1['fname'];
$lastname=$row_Recordset1['lname'];
$emailaddr=$row_Recordset1['email'];
  if($row_Recordset1['email']!=NULL) {
	  echo ("&lt;$lastname, $firstname&gt; $emailaddr; ");
	}
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>
