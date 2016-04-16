<?php require_once('../Connections/W3OITesting.php');?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "5";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    /*if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    */
	if(($UserName=='w3oitreasury')) {
	  $isValid = true; 
    }
	/*
	if (($strUsers == "") && true) { 
      $isValid = true; 
    } */ 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE members SET fname=%s, mid=%s, lname=%s, title=%s, suffix=%s, fcccall=%s, `class`=%s, addr1=%s, addr2=%s, city=%s, `state`=%s, zip=%s, cnty=%s, email=%s, busfone=%s, hfone=%s, unlfone=%s WHERE member_id=%s",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['mname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['suffix'], "text"),
                       GetSQLValueString($_POST['fcccall'], "text"),
                       GetSQLValueString($_POST['fccclass'], "text"),
                       GetSQLValueString($_POST['addr1'], "text"),
                       GetSQLValueString($_POST['addr2'], "text"),
                       GetSQLValueString($_POST['city'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['zip'], "text"),
                       GetSQLValueString($_POST['county'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['busfone'], "text"),
                       GetSQLValueString($_POST['hfone'], "text"),
                       GetSQLValueString($_POST['unlfone'], "text"),
                       GetSQLValueString($_POST['member_id'], "int"));

  mysql_select_db($database_W3OITesting, $W3OITesting);
  $Result1 = mysql_query($updateSQL, $W3OITesting) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_GET['member_id'])) {
  $colname_Recordset1 = $_GET['member_id'];
}

if( ! function_exists("GetSQLValueString"))
{
   function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
   {
      if(PHP_VERSION < 6)
      {
         $theValue = get_magic_quotes_gpc()? stripslashes($theValue): $theValue;
      }

      $theValue = function_exists("mysql_real_escape_string")? mysql_real_escape_string($theValue): mysql_escape_string($theValue);

      switch($theType)
      {
         case "text":
            $theValue = ($theValue != "")? "'" . $theValue . "'": "NULL";
            break;
         case "long":
         case "int":
            $theValue = ($theValue != "")? intval($theValue): "NULL";
            break;
         case "double":
            $theValue = ($theValue != "")? doubleval($theValue): "NULL";
            break;
         case "date":
            $theValue = ($theValue != "")? "'" . $theValue . "'": "NULL";
            break;
         case "defined":
            $theValue = ($theValue != "")? $theDefinedValue: $theNotDefinedValue;
            break;
      }
      return $theValue;
   }
}

mysql_select_db($database_W3OITesting, $W3OITesting);
$colname_Recordset1 = "-1";//placeholder
//check if direct query for member or search requested
if(isset($_POST['Search']))
{
   //search is requested need to run this query first to get the member_id
   $search = $_POST['Search'];
   $query_Recordset0 = "SELECT * FROM members WHERE (`fcccall` LIKE '%$search%') OR" . "(`lname` LIKE '%$search%')";
}
else
{
   //search by url id given
   if(isset($_GET['member_id']))
   {
      $memberid = $_GET['member_id'];
      echo "Get By MemberID: $memberid";
	  $query_Recordset0 = "SELECT * FROM members WHERE member_id = $memberid";
   }
}
$Recordset1 = mysql_query($query_Recordset0, $W3OITesting) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$colname_Recordset1 = $row_Recordset0['member_id'];
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
echo "Rows returned: $totalRows_Recordset1";
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/memeditnav.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit By MemberId</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
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
      <a class="navbar-brand" href="..\index.html">W3OI</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="topFixedNavbar1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="membersarea.php">Members Area<span class="sr-only">(current)</span></a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Member Edit<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Add</a></li>
            <li><a href="#">Update</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Mark Paid Bulk</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Call, Lstname, MemberId">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<!-- InstanceBeginEditable name="EditRegion3" -->
<div class="container">
<form method="POST" action="<?php echo $editFormAction; ?>" name="form">
<fieldset><legend>Member Identification:</legend>
<p>MemberID: <input type="text" name="member_id" readonly value="<?php echo $row_Recordset1['member_id']; ?>"></p></fieldset>
<fieldset><legend>Name Information:</legend>
  <p>Title: <input type="text" name="title" value="<?php echo $row_Recordset1['title']; ?>"></p>
  <p>First name:
    <input name="fname" type="text" value="<?php echo $row_Recordset1['fname']; ?>">
  </p>
  <p>Middle: 
    <input type="text" name="mname" value="<?php echo $row_Recordset1['mid']; ?>">
  </p>
  <p>Last:
    <input type="text" name="lname" value="<?php echo $row_Recordset1['lname']; ?>">
  </p>
  <p>Suffix: 
    <input type="text" name="suffix" value="<?php echo $row_Recordset1['suffix']; ?>">
  </p>
</fieldset>
<fieldset><legend>Contact Information:</legend>
  <p>Email: 
    <input type="email" name="email" value="<?php echo $row_Recordset1['email']; ?>">
  </p>
  <p>Home Phone: 
   <input type="tel" name="hfone" value="<?php echo $row_Recordset1['hfone']; ?>">
  </p>
  <p>Business Phone: 
    <input type="tel" name="busfone" value="<?php echo $row_Recordset1['busfone']; ?>">
  </p>
  <p>Unlisted Phone: 
    <input type="tel" name="unlfone" value="<?php echo $row_Recordset1['unlfone']; ?>">
  </p>
<fieldset><legend>Address Information:</legend>
  <p>Address1: 
    <input type="text" name="addr1" value="<?php echo $row_Recordset1['addr1']; ?>"><br></p>
  <p>Address2:  <input type="text" name="addr2" value="<?php echo $row_Recordset1['addr2']; ?>">
    <br>
  </p>
  <p>City: 
    <input type="text" name="city" value="<?php echo $row_Recordset1['city']; ?>">
  </p>
  <p>State: 
    <input type="text" name="state" value="<?php echo $row_Recordset1['state']; ?>">
  </p>
  <p>Zip: 
    <input type="text" name="zip" value="<?php echo $row_Recordset1['zip']; ?>">
  </p>
  <p>County: 
    <input type="text" name="county" value="<?php echo $row_Recordset1['cnty']; ?>">
  </p>
</fieldset>
<fieldset><legend>License Information:</legend>
  <p>Callsign: 
    <input type="text" name="fcccall" value="<?php echo $row_Recordset1['fcccall']; ?>">
  </p>
  <p>Class: 
    <input type="text" name="fccclass" value="<?php echo $row_Recordset1['class']; ?>">
  </p>
</fieldset>
<input type="hidden" name="MM_update" value="form">
<input type="submit" value="Update"></form>
</div>
<?php
mysql_free_result($Recordset1);
?>
<!-- InstanceEndEditable -->
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
<!-- InstanceEnd --></html>