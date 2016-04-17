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
//if a post is received handle it here
function checkPostArray($array, $W3OITesting){
  try
  {
     //check for empty post information
	 if(count($array)==0) return;
	 //post information given start to parse
	 foreach ($array as $key => $value) {
    	echo "$key => $value<br>";
      }
	  $values="'" . $array["title"] . "', ";
	  $values.="'" . $array["fname"] . "', ";
	  $values.="'" . $array["mname"] . "', ";
	  $values.="'" . $array["lname"] . "', ";
	  $values.="'" . $array["suffix"] . "', ";
	  $values.="'" . $array["fcccall"] . "', ";
	  $values.="'" . $array["class"] . "', ";
	  $values.="'" . $array["addr1"] . "', ";
	  $values.="'" . $array["addr2"] . "', ";
	  $values.="'" . $array["city"] . "', ";
	  $values.="'" . $array["state"] . "', ";
	  $values.="'" . $array["county"] . "', ";
	  $values.="'" . $array["zip"] . "', ";
	  $values.="'" . $array["email"] . "', ";
	  $values.="'" . $array["busfone"] . "', ";
	  $values.="'" . $array["hfone"] . "', ";
	  $values.="'" . $array["mfone"] . "', ";
	  $values.="'" . $array["unlfone"] . "', ";
	  $values.= "'" . date('Y-m-d') . "', ";
	  $values.="'" . $array["note"] . "'";
	  $paymenttype=$array["MemType"];
	  echo "$values<br>";
	  //create the query to add the new member
	  $query_Recordset2 = "INSERT INTO members (member_id, title, fname, mid, ".
	  "lname, suffix, fcccall, class, addr1, addr2, city, state, zip, cnty, email, ".
      "busfone, hfone, mfone, unlfone,lastupdt, note) VALUES (NULL, $values)";
      echo "$query_Recordset2<br>";
	  mysql_query($query_Recordset2, $W3OITesting) or die(mysql_error());
	  echo "New Member Created!<br>";
	  //add the payment information
	  //if it's before Oct 1 (the cutoff date) the member is for this year
	  //otherwise it's for next year
	  $checkmonth=date('m');
	  if($checkmonth>=10) {
	    echo "After October It's next year.<br>";
	    $paymentyear=date('Y', strtotime('+1 year')) . "-12-31";
	   }
	  else {
	    echo "Before October It's this year.<br>";
	    $paymentyear=date('Y') . "-12-31";
	  }
	  $query_Recordset2 = "INSERT INTO paid (paid_id, member_id, year, type) VALUES (NULL, LAST_INSERT_ID(), '$paymentyear', '$paymenttype')";
      echo "$query_Recordset2<br>";
	  mysql_query($query_Recordset2, $W3OITesting) or die(mysql_error());
	  echo "Payment information updated!<br>";
  }
  catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
}

checkPostArray($_POST, $W3OITesting);

?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/memeditnav.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Member</title>
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
        <li class="inactive"><a href="membersarea.php">Members Area<span class="sr-only"></span></a></li>
        <li class="dropdown"><a href="membershipmanagerhome.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Member Edit<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addmember.php">Add</a></li>
            <?php
            if($isID) {
            echo "<li><a href=\"editfromid.php?member_id=$search\">Update</a></li>";
             }          
            ?>
            <li><a href="removemember.php">Remove</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="markpaidbulk.php">Mark Paid Bulk</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="createfamily.php">Create Family</a></li>
            <li><a href="editfamily.php">Edit Family</a></li>
            <li><a href="viewfamilies.php">View Families</a></li>
            <li><a href="removefamily.php">Disband Family</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="markbustemails.php">Mark Bust Emails</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="membershiptrends.php">Membership Trends</a></li>
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
<div class="container">
<form method="post" action="addmember.php" name="form">
<fieldset><legend>Member Identification:</legend>
<p>MemberID: <input type="text" name="member_id" readonly value="NULL"></p></fieldset>
<fieldset><legend>Name Information:</legend>
  <p>Title: <input type="text" name="title" value=""></p>
  <p>First name:
    <input name="fname" type="text" value="">
  </p>
  <p>Middle: 
    <input type="text" name="mname" value="">
  </p>
  <p>Last:
    <input type="text" name="lname" value="">
  </p>
  <p>Suffix: 
    <input type="text" name="suffix" value="">
  </p>
</fieldset>
<fieldset><legend>Contact Information:</legend>
  <p>Email: 
    <input type="email" name="email" value="">
  </p>
  <p>Home Phone: 
   <input type="tel" name="hfone" value="">
  </p>
  <p>Mobile Phone: 
   <input type="tel" name="mfone" value="">
  </p>
  <p>Business Phone: 
    <input type="tel" name="busfone" value="">
  </p>
  <p>Unlisted Phone: 
    <input type="tel" name="unlfone" value="">
  </p>
<fieldset><legend>Address Information:</legend>
  <p>Address1: 
    <input type="text" name="addr1" value=""><br></p>
  <p>Address2:  <input type="text" name="addr2" value="">
    <br>
  </p>
  <p>City: 
    <input type="text" name="city" value="">
  </p>
  <p>State: 
    <input type="text" name="state" value="PA">
  </p>
  <p>Zip: 
    <input type="text" name="zip" value="">
  </p>
  <p>County: 
    <input type="text" name="county" value="Lehigh">
  </p>
</fieldset>
<fieldset><legend>License Information:</legend>
  <p>Callsign: 
    <input type="text" name="fcccall" value="">
  </p>
  <p>Class: 
    <input type="text" name="fccclass" value="T">
  </p>
</fieldset>
<fieldset><legend>Notes:</legend>
  <p>Note: 
    <input type="text" name="note" value="">
  </p>
</fieldset>
<p>
    <label>
      <input type="radio" name="MemType" value="R" id="">
      Regular</label>
    <label>
      <input type="radio" name="MemType" value="F" id="">
      Family</label>
    <label>
      <input type="radio" name="MemType" value="A" id="">
      Associate</label>
    <label>
      <input type="radio" name="MemType" value="L" id="">
      Lifetime</label>
</p>
<input type="submit" value="Add"></form>
</div>
<?php
mysql_free_result($Recordset1);
?>
<!-- InstanceEndEditable -->
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
<!-- InstanceEnd --></html>
