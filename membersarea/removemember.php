<?php require_once('../Connections/W3OITesting.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
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
mysql_select_db($database_W3OITesting, $W3OITesting);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/memeditnav.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Remove Member</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
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
        <li class="inactive"><a href="membersarea.php">Members Area<span class="sr-only"></span></a></li>
        <li class="dropdown"><a href="membershipmanagerhome.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Member Edit<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addmember.php">Add</a></li>
            <?php
            if($isID) {
            echo "<li><a href=\"editfromid.php?member_id=$search\">Update</a></li>";
             }          
            ?>
            <li class="disabled"><a href="removemember.php">Remove</a></li>
            <li role="separator" class="divider"></li>
            <li class="disabled"><a href="markpaidbulk.php">Mark Paid Bulk</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="createfamily.php">Create Family</a></li>
            <li class="disabled"><a href="editfamily.php">Edit Family</a></li>
            <li><a href="viewfamilies.php">View Families</a></li>
            <li class="disabled"><a href="removefamily.php">Disband Family</a></li>
            <li role="separator" class="divider"></li>
            <li class="disabled"><a href="markbustemails.php">Mark Bust Emails</a></li>
            <li role="separator" class="divider"></li>
          </ul>
        </li>
        <li class="dropdown"><a href="membershipmanagerhome.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="unrenewed.php">Expired members</a></li>
            <li class="disabled"><a href="membershiptrends.php">Membership Trends</a></li>
           </ul>
        </li>
      </ul>
      <form method="post" class="navbar-form navbar-left"
      action="membershipmanager.php">
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
</nav>
<!-- InstanceBeginEditable name="EditRegion3" -->
<!-- InstanceEndEditable -->
<script src="../../js/jquery-1.11.3.min.js"></script>
<script src="../../js/bootstrap.js"></script>
</body>
<!-- InstanceEnd --></html>
