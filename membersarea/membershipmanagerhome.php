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
<!doctype html>
<html><!-- InstanceBegin template="/Templates/memeditnav.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Membership Manager Home</title>
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
<h2>W3OI Member Management Area</h2>
<h4>Adding a member</h4>
<p>
To add a member go to the member edit menu above and select the Add drop down menu item. Fill out the required fields as necessary and select the member type. Press the Add button on the bottom of the form and the member will be added to the database and the payment information will be updated based on the selection.
</p>
<p>
Adding a member with payment information will automatically place the member on the W3OI site under the membership roster.
</p>
<h4>Editing a member</h4>
<p>
To edit a member type all or some of the member's last name, callsign or member's ID number (if you know it) into the search box at the top of the page. If there is only one member which meets this criteria you can select Member Edit -> Update from the top menu. If you were given more than one member type the member ID of the desired member to edit in the top search box and then select Member Edit -> Update. 
</p>
<p>
Enter the updated information into the fields and press the Update button. If payment information needs to be updated you can also optionally select the member payment type. </p>
<h4>Payments</h4>
<p>
Payment information entered prior to October 1st of the current year will be entered onto the current year. Any payment information added on or after October 1st will be placed onto the subsequent year.
</p>
<h4>Creating a family</h4>
<p>
To create a family select the Member Edit -> Create Family menu item from the top navigation. Select the members from the list which should be in this family and then press the update button at the bottom.
</p>
Creating a family gives the added benefit of automatically updating payment information for the family as a whole. For example, editing any one member of a family and adding a payment type of 'Family' will automatically update payment records for all other members in this family.
<h4>Viewing a family</h4>
<p>
With the View Family menu item chosen this will give you a list of all the W3OI family associations in the database.
</p>
</div>
<!-- InstanceEndEditable -->
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
<!-- InstanceEnd --></html>
