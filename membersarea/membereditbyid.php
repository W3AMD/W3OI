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
mysql_select_db($database_W3OITesting, $W3OITesting);
//check if direct query for member or search requested
if(isset($_POST['Search']))
{
   //search is requested need to run this query first to get the member_id
   $search = $_POST['Search'];
   $query_Recordset1 = "SELECT * FROM members WHERE (`fcccall` LIKE            '%$search%') OR (`lname` LIKE '%$search%') OR `member_id`=$search";
   $Recordset1 = mysql_query($query_Recordset1, $W3OITesting) or die(mysql_error());
   $row_Recordset1 = mysql_fetch_assoc($Recordset1);
   $colname_Recordset1 = $row_Recordset1['member_id'];
   $totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
   $query_Recordset0 = "SELECT * FROM members WHERE (`fcccall` LIKE '%$search%') OR" .
   "(`lname` LIKE '%$search%')";
   $Recordset0 = mysql_query($query_Recordset0, $W3OITesting) or die(mysql_error());
   $row_Recordset0 = mysql_fetch_assoc($Recordset0);
   $colname_Recordset1 = $row_Recordset0['member_id'];
}
else
{
   //search by url id given
   if(isset($_GET['member_id']))
   {
      $colname_Recordset1 = $_GET['member_id'];
   }
}
$query_Recordset1 = sprintf("SELECT * FROM members WHERE member_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $W3OITesting) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<html><!-- InstanceBegin template="/Templates/W3OImembershipmanager.dwt.php" codeOutsideHTMLIsLocked="false" -->

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- InstanceBeginEditable name="TitleEdit" -->TitleEdit
<title>Member Editor</title>
<!-- InstanceEndEditable -->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<nav class="navbar navbar-default navbar-fixed-top"><body style="padding-top: 70px">
  
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topFixedNavbar1" aria-expanded="false"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="membersarea.php">W3OI Members Area</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="topFixedNavbar1">
      <ul class="nav navbar-nav">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Member Editor<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addmember.php">Add Member</a></li>
            <?php
            if (isset($_GET['member_id'])) {
                $memberid = $_GET['member_id'];
                }
            echo "<li><a href=\"membereditbyid.php?member_id=$memberid\">Update Member</a></li>";
            ?>
            <li><a href="updatememberpayment.php">Add Member Payment Record</a></li>
            <li><a href="markpaidbulk.php">Mark Bulk Payment Records</a></li>
          </ul>
        </li>
      </ul>
      <form method="post" class="navbar-form navbar-left"
      action="membershipeditor.php">
        <div class="form-group">
          <input type="text" class="form-control" name="Search" placeholder="Call, Lname, MemberID">
        </div>
        <button type="submit" class="btn btn-default" id="Submit" >Search</button>
        </a>
      </form>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
  <!-- InstanceBeginEditable name="BodyEditRegion2" -->
  <!-- InstanceEndEditable -->
</body>
</nav>
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<!-- InstanceEnd --></html>
