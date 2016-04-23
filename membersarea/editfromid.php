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
    case "bool":
      $theValue = ($theValue != "") ? intval(1) : intval(0);
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
  //get todays date for the last record update
  $today=date('Y-m-d');
  $updateSQL = sprintf("UPDATE members SET fname=%s, mid=%s, lname=%s, title=%s, suffix=%s, fcccall=%s, `class`=%s, addr1=%s, addr2=%s, city=%s, `state`=%s, zip=%s, cnty=%s, email=%s, busfone=%s, hfone=%s, mfone=%s, unlfone=%s, note=%s, silentkey=%s, ndbdg=%s, ndcard=%s, lastupdt=%s WHERE member_id=%s",
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
                       GetSQLValueString($_POST['mfone'], "text"),
                       GetSQLValueString($_POST['unlfone'], "text"),
                       GetSQLValueString($_POST['note'], "text"),
                       GetSQLValueString($_POST['skey'], "bool"),
                       GetSQLValueString($_POST['needbadge'], "bool"),
                       GetSQLValueString($_POST['needcard'], "bool"),
                       GetSQLValueString($today, "text"),
                       GetSQLValueString($_POST['member_id'], "int"));

  mysql_select_db($database_W3OITesting, $W3OITesting);
  $Result1 = mysql_query($updateSQL, $W3OITesting) or die(mysql_error());
  $paymenttype=$_POST['MemType'];
  if($paymenttype!='') {
		 //add the payment information
         //if it's before Oct 1 (the cutoff date) the member is for this year
         //otherwise it's for next year
         $checkmonth=date('m');
         if($checkmonth>=10) {
	       //echo "After October payments are for next year.<br>";
	       $paymentyear=date('Y', strtotime('+1 year')) . "-12-31";
	      }
         else {
	       //echo "Before October payment is for this year.<br>";
	       $paymentyear=date('Y') . "-12-31";
	     }
	  //check if a payment record already exists for this year
      $query_Recordset2 = "SELECT * From paid where member_id = " .
	  GetSQLValueString($_POST['member_id'], "int") . " AND year = '" .
	  $paymentyear . "'";
	  $Recordset2 = mysql_query($query_Recordset2, $W3OITesting) or die(mysql_error());
	  $totalRows_Recordset2 = mysql_num_rows($Recordset2);
      if($totalRows_Recordset2>0) {
	      echo "Payment information already exists for $paymentyear!<br>";
	  }
	  else {
        //check if this member is part of a family if so update all family members payments
        //run the query to find out if this member is in a family
		$query_Recordset2 = "SELECT * From family where member_id = " .
	    GetSQLValueString($_POST['member_id'], "int");
	    $Recordset2 = mysql_query($query_Recordset2, $W3OITesting) or die(mysql_error());
	    $totalRows_Recordset2 = mysql_num_rows($Recordset2);
        $row_Recordset2 = mysql_fetch_assoc($Recordset2);
        $familyid = $row_Recordset2['family_id'];
        if($totalRows_Recordset2>0) {
	      //this member is part of a family so we'll need to update all the payment records
		  //for the family
		  //first check if the payment type is correct, it should be 'F' for family
		  if($paymenttype!='F') {
		      echo "Error, This member is part of family but you didn't select family for payment type.<br>";
	          }
		  else {
			  echo "This member is part of family with ID: $familyid<br>";
	          $query_Recordset2 = "SELECT * From family where family_id = " . GetSQLValueString($familyid, "int");
	          $Recordset2 = mysql_query($query_Recordset2, $W3OITesting) or die(mysql_error());
	          while ($row = mysql_fetch_array($Recordset2, MYSQL_ASSOC)) {
	      	      $memberid = $row['member_id'];
         		  //finally insert the payment record
	              $query_Recordset2 = "INSERT INTO paid (paid_id, member_id, year, type) VALUES (NULL," . 
                      GetSQLValueString($memberid, "int") . ", '$paymentyear', '$paymenttype')";
                  mysql_query($query_Recordset2, $W3OITesting) or die(mysql_error());
	              echo "Payment information updated for $memberid!<br>";
    		    }
	        }
		 }
	    else {
		  //finally insert the payment record
	      $query_Recordset2 = "INSERT INTO paid (paid_id, member_id, year, type) VALUES (NULL," . 
          GetSQLValueString($_POST['member_id'], "int") . ", '$paymentyear', '$paymenttype')";
          mysql_query($query_Recordset2, $W3OITesting) or die(mysql_error());
	      echo "Payment information updated!<br>";
		}
	  }
  }
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
//search by url id given
if(isset($_GET['member_id']))
   {
      $memberid = $_GET['member_id'];
 	  $query_Recordset0 = "SELECT * FROM members WHERE member_id = $memberid";
   }
$Recordset1 = mysql_query($query_Recordset0, $W3OITesting) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$colname_Recordset1 = $row_Recordset0['member_id'];
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
            <li class="disabled"><a href="membershiptrends.php">Membership Trends</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="disabled"><a href="./reports/reportbustemaillist.php">Bust Email List</a></li>
            <li class="disabled"><a href="./reports/reportbogemaillist.php">BOG Email List</a></li>
            <li class="disabled"><a href="./reports/reportbogphonelist.php">BOG Home Phone List</a></li>
            <li class="disabled"><a href="./reports/reportbogdatalist.php">BOG Data List</a></li>
            <li role="separator" class="divider"></li>
            <li class="disabled"><a href="./reports/reportofficersemaillist.php">Officers' Email List</a></li>
            <li class="disabled"><a href="./reports/reportofficersphonelist.php">Officers' Home Phone List</a></li>
            <li class="disabled"><a href="./reports/reportofficersdatalist.php">Officers' Data List</a></li>
            <li role="separator" class="divider"></li>
            <li class="disabled"><a href="./reports/reportneedbadgcardlist.php">Need Badges Or Cards List</a></li>
            <li class="disabled"><a href="./reports/reportassociateslist.php">Find Associate Members List</a></li>
            <li class="disabled"><a href="./reports/reportpaidmemberslist.php">Paid Members List</a></li>
            <li class="disabled"><a href="./reports/reportpaidmembersaddrlist.php">Paid Members Address List</a></li>
            <li class="disabled"><a href="./reports/reportexpiredlist.php">Expired Members List</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Functions<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="disabled"><a href="./functions/funcclearcardbadgeflags.php">Clear All Need Card / Badge Flags</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Training<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="./training/addmember.php">Adding A Member</a></li>
            <li><a href="./training/editmember.php">Editing Members</a></li>
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
<?php
if($totalRows_Recordset1<1) {
echo "<h4>Too many members in the search list. Do a search by member ID to update the record.</h4>";
exit;
}
?>
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
  <p>Mobile Phone: 
   <input type="tel" name="mfone" value="<?php echo $row_Recordset1['mfone']; ?>">
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
<fieldset><legend>Notes:</legend>
  <p>Note: 
    <input type="text" name="note" size="100" value="<?php echo $row_Recordset1['note']; ?>">
  </p>
  <p> 
    <input type="checkbox" name="skey" value="silentkey"<?php
    if($row_Recordset1['silentkey']==1)
	echo "checked";?>>Silent Key
  </p>
  <p> 
    <input type="checkbox" name="needbadge" value="needbadge"<?php
    if($row_Recordset1['ndbdg']==1)
	echo "checked";?>>Needs Badge
  </p>
  <p> 
    <input type="checkbox" name="needcard" value="needcard"<?php
    if($row_Recordset1['ndcard']==1)
	echo "checked";?>>Needs Member Card
  </p>
</fieldset>
<fieldset><legend>Add Payment:</legend><p>
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
