<?php require_once('../Connections/W3OITesting.php');?>
<?php
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
//placeholders
$colname_Recordset1 = "-1";
$row_Recordset1 = "-1";
$colname_Recordset1 = "-1";
$Recordset1 = "-1";
$totalRows_Recordset1 = "1";
//check if direct query for member or search requested
if(isset($_POST['Search']))
{
   //search is requested need to run this query first to get the member_id
   $search = $_POST['Search'];
   $query_Recordset1 = "SELECT * FROM members WHERE (`fcccall` LIKE '%$search%') OR" .
   "(`lname` LIKE '%$search%')";
   $Recordset1 = mysql_query($query_Recordset1, $W3OITesting) or die(mysql_error());
   $row_Recordset1 = mysql_fetch_assoc($Recordset1);
   $colname_Recordset1 = $row_Recordset1['member_id'];
   $totalRows_Recordset1 = mysql_num_rows($Recordset1);
}
/*
else
{
   //search by url id given
   if(isset($_GET['member_id']))
   {
      $colname_Recordset1 = $_GET['member_id'];
      $query_Recordset1 = sprintf("SELECT * FROM members WHERE member_id = %s", GetSQLValueString($colname_Recordset1, "int"));
      $Recordset1 = mysql_query($query_Recordset1, $W3OITesting) or die(mysql_error());
      $row_Recordset1 = mysql_fetch_assoc($Recordset1);
      $totalRows_Recordset1 = mysql_num_rows($Recordset1);
   }
}*/
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/W3OIMemAreaNavTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<!-- InstanceBeginEditable name="doctitle" -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Member Infomation</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<!-- <link href="file:///C|/Users/John/Documents/HTML5 Builder/Projects/W3OI/css/bootstrap.css" rel="stylesheet" type="text/css"> -->
<link href="../../css/bootstrap-3.3.6.css" rel="stylesheet" type="text/css">
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
      <a class="navbar-brand" href="membersarea.php">W3OI Members Area</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="btn-group">
      <button type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports<span class="caret"></span></button>
      <ul class="dropdown-menu">
        <!--<li role="presentation" class="dropdown-header">Members List</li>-->
        <li role="presentation"><a href="datadump.php">Active Members Data File</a></li>
        <li role="presentation"><a href="bulkactiveemaillist.php">Recent Email List</a></li>
        <!--<li role="presentation" class="disabled"><a href="#">Disabled Link</a></li>-->
        <!--<li role="presentation" class="divider"></li>-->
        <!--<li role="presentation"><a href="#">Separated Link</a></li>-->
      </ul>
    </div>
    <?php if(isset($_GET['Treasury'])) {
	echo ('<div class="btn-group">
      <button type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Treasury Reports<span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li role="presentation"><a href="#">Valid Email List</a></li>
        <li role="presentation"><a href="#">Busted Email List</a></li>
        <li role="presentation"><a href="#">BoG Email List</a></li>
        <li role="presentation"><a href="#">BoG Home Phone List</a></li>
        <li role="presentation"><a href="#">BoG Data List</a></li>
        <li role="presentation"><a href="#">Need Badges or Cards List</a></li>
        <li role="presentation"><a href="#">Associate Members List</a></li>
        <li role="presentation"><a href="#">Paid Members List</a></li>
        <li role="presentation"><a href="#">Address Labels List</a></li>
        <li role="presentation"><a href="#">Overdue Members List</a></li>
        <li role="presentation"><a href="#">Clear Card And Badges Fields</a></li>
        <!--<li role="presentation" class="disabled"><a href="#">Disabled Link</a></li>-->
        <!--<li role="presentation" class="divider"></li>-->
        <!--<li role="presentation"><a href="#">Separated Link</a></li>-->
      </ul>
    </div>
    <div class="btn-group">
      <button type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Member Editor<span class="caret"></span></button>
      <ul class="dropdown-menu">
        <!--<li role="presentation" class="dropdown-header">Members List</li>-->
        <li role="presentation"><a href="#">Add</a></li>
        <li role="presentation"><a href="../membersarea/memberinfoeditor.php">Update</a></li>
        <li role="presentation"><a href="#">Add Paid Records</a></li>
        <!--<li role="presentation" class="disabled"><a href="#">Disabled Link</a></li>-->
        <!--<li role="presentation" class="divider"></li>-->
        <!--<li role="presentation"><a href="#">Separated Link</a></li>-->
      </ul>
    </div>');
    }
    ?>
    <?php if(isset($_GET['Board'])) {
	echo ('<div class="btn-group">
      <button type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Board Functions<span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li role="presentation"><a href="#">Send Bulk Email</a></li>
      </ul>
    </div>');
    }
    ?>
    <div class="collapse navbar-collapse" id="topFixedNavbar1">
      <ul class="nav navbar-nav navbar-right">
      <form method="post" class="navbar-form navbar-left"
      action="memberinfo.php">
        <div class="form-group">
          <input type="text" class="form-control" name="Search" placeholder="Callsign or Lastname">
        </div>
        <button type="submit" class="btn btn-default" id="Submit" >Search</button>
        </a>
      </form>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<script src="../../js/jquery-1.11.3.min.js"></script>
<!-- <script src="file:///C|/Users/John/AppData/Roaming/Adobe/Dreamweaver CC 2015/en_US/Configuration/Temp/Assets/eam4A93.tmp/js/bootstrap.js"></script> -->
<script src="../../js/bootstrap-3.3.6.js"></script>
<!-- InstanceBeginEditable name="EditRegion3" -->
<div class="container">
<h4>Number of members found: <?php 
if($totalRows_Recordset1<1) {
	echo 'No members found.';
    return;
}
else {
	echo $totalRows_Recordset1;
?></h4></div>
<?php
}
do { 
?>
<div class="container">
<form>
<fieldset><legend>Name Information:</legend>
  <p>Title: </span><?php echo $row_Recordset1['title'];?></p>
  <p>First:
<?php echo $row_Recordset1['fname'];?>    </p>
  <p>Middle: <?php echo $row_Recordset1['mid'];?></p>
  <p>Last:
<?php echo $row_Recordset1['lname'];?></p>
  <p>Suffix: <?php echo $row_Recordset1['suffix'];?></p>
</fieldset>
<fieldset><legend>Contact Information:</legend>
  <p>Email: <?php echo $row_Recordset1['email'];?>
  </p>
  <p>Home Phone: <?php echo $row_Recordset1['hfone'];?></p>
  <p>Business Phone: <?php echo $row_Recordset1['busfone'];?></p>
  <p>Unlisted Phone: <?php echo $row_Recordset1['unlfone'];?></p>
<fieldset><legend>Address Information:</legend>
  <p>Address: <?php echo $row_Recordset1['addr1'];?><br><?php echo $row_Recordset1['addr2'];?></p>
  <p>City: <?php echo $row_Recordset1['city'];?></p>
  <p>State: <?php echo $row_Recordset1['state'];?></p>
  <p>Zip: <?php echo $row_Recordset1['zip'];?></p>
  <p>County: <?php echo $row_Recordset1['cnty'];?></p>
</fieldset>
<fieldset><legend>License Information:</legend>
  <p>Callsign: <?php echo $row_Recordset1['fcccall'];?></p>
  <p>Class: <?php echo $row_Recordset1['class'];?></p>
</fieldset>
</form>
</div>
<?php  } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>