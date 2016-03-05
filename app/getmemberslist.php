
<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers And KC3ASC Igor Kasriel

//this script gets the member information and status from the main W3OI
//database. it searches the database for the officers, then board members,
//and then displays the members information to the screen.
//it also loads each member image which exist from the members/images/thumbs
//directory

//see lvarc.css for visual display and orientation classes
include('../includes/sqlfunctions.inc.php');
include('../includes/connection2.inc.php');

//function to display the call sign from the database and it's associated
//QRZ link if displayaslink is true or no second parameter are given
//takes in the SQL query result row
function displayCallAndQRZLink($row, $displayaslink = true)
{
   //use callsign to add slash zero if needed
   $callsign = $row['fcccall'];
   $callsign = str_replace('0', '&Oslash;', $callsign);
   //search the callsign for a zero character
   if($displayaslink)
   {
      //output the callsign link
      echo " <a href='http://www.qrz.com/db/" .
      $row['fcccall'] . "' target='_blank'>" . $callsign . "</a>";
   }
   else
   {
      //output just the callsign without link
      echo $row['fcccall'];
   }
}

//this function displays the members thumbnail
//it takes in row which is a row of data in the basename
function displayMemberIcon($row)
{
   //do this only if an image file exists
   $callsign = $row['fcccall'];
   $fulldir/*$dir . */ = '../members/images/thumbs/';

   $exists = file_exists($fulldir . $callsign . ".jpg");
   //echo $fulldir . $callsign . '.jpg<br>';
   if($exists)
   {
      echo '<img src="members/images/thumbs/' . $callsign .
      '.jpg" width="100" height="auto" alt="" class="memberIcon">';
   }
   else
   {
      echo '<img src="members/images/thumbs/anon.jpg" width="100" height="auto"
      alt="" class="memberIcon">';
   }
}

//this function displays the members name and formats a space
//for the upcoming callsign to be displayed next
//it takes in the SQl query row from the membership database
function displayFullName($row)
{
   echo $row['title'] . " " . $row['fname'] . " " . $row['mid'] . " " .
   $row['lname'] . " " . $row['suffix'];
}

//this function displays a string to the output in bold and continues bold
//adds a colon and space if required
//this function is used for displaying member names
function displayStartTitleBold($output, $addspace = true, $addcolon = true)
{
   echo '<b>' . $output;
   if($addcolon)
      echo ':';
   if($addspace)
      echo ' ';
   echo '</b>';
}

?>
<!DOCTYPE HTML>
<html>
        <meta charset="utf-8">
<div class="memberpagetitles">
<title>Members</title>
<body>
<h2 class="header"> Officers For
<?php
$year = date("Y");
echo $year;
?>
</h2>
<div class="marginOfficers">
</div>
<?php
$connection1 = dbConnect();
//run the query to get the current officers
$yearfull = $year . '-00-00';
$findrecords = "select * from members, officersboard " .
"Where (`members`.`member_id` = `officersboard`.`member_id`) AND" .
" (year > '$yearfull') AND (`officersboard`.`type`='P');";
$result = _mysql_query($connection1, $findrecords);
//<!-- <div class="row officers"> -->
//if query is successful display the president always use bold
if($result)
{
   while($row = _mysql_fetch_assoc($connection1, $result))
   {
      echo '<div class="row officers">';
      echo '<div class="col-md-3 col-md-offset-2 col-xs-4 col-xs-offset-0 string">';
      displayStartTitleBold("President");
      echo '</div><div class="col-md-3 col-xs-4 string">';
      displayFullName($row);
      echo '</div><div class="col-md-3 col-xs-2 string">';
      displayCallAndQRZLink($row);
      echo '</div>';
      echo '</div>';
   }
   $findrecords = "select * from members, officersboard " .
   "Where (`members`.`member_id` = `officersboard`.`member_id`) AND" .
   " (year > '$yearfull') AND (`officersboard`.`type`='V');";
   $result = _mysql_query($connection1, $findrecords);
   //if query is successful display the vice president always use bold
   if($result)
   {
      while($row = _mysql_fetch_assoc($connection1, $result))
      {
         echo '<div class="row officers">';
         echo '<div class="col-md-3 col-md-offset-2 col-xs-4 col-xs-offset-0 string">';
         displayStartTitleBold("Vice President");
         echo '</div><div class="col-md-3 col-xs-4 string">';
         displayFullName($row);
         echo '</div><div class="col-md-3 col-xs-2 string">';
         displayCallAndQRZLink($row);
         echo '</div>';
         echo '</div>';
      }
   }
   $findrecords = "select * from members, officersboard " .
   "Where (`members`.`member_id` = `officersboard`.`member_id`) AND" .
   " (year > '$yearfull') AND (`officersboard`.`type`='S');";
   $result = _mysql_query($connection1, $findrecords);
   //if query is successful display the secretary always use bold
   if($result)
   {
      while($row = _mysql_fetch_assoc($connection1, $result))
      {
         echo '<div class="row officers">';
         echo '<div class="col-md-3 col-md-offset-2 col-xs-4 col-xs-offset-0 string">';
         displayStartTitleBold("Secretary");
         echo '</div><div class="col-md-3 col-xs-4 string">';
         displayFullName($row);
         echo '</div><div class="col-md-3 col-xs-2 string">';
         displayCallAndQRZLink($row);
         echo '</div>';
         echo '</div>';
      }
   }
   $findrecords = "select * from members, officersboard " .
   "Where (`members`.`member_id` = `officersboard`.`member_id`) AND" .
   " (year > '$yearfull') AND (`officersboard`.`type`='T');";
   $result = _mysql_query($connection1, $findrecords);
   //if query is successful display the treasurer always use bold
   if($result)
   {
      while($row = _mysql_fetch_assoc($connection1, $result))
      {
         echo '<div class="row officers">';
         echo '<div class="col-md-3 col-md-offset-2 col-xs-4 col-xs-offset-0 string">';
         displayStartTitleBold("Treasurer");
         echo '</div><div class="col-md-3 col-xs-4 string">';
         displayFullName($row);
         echo '</div><div class="col-md-3 col-xs-2 string">';
         displayCallAndQRZLink($row);
         echo '</div>';
         echo '</div>';
      }
   }
}
//<!-- </div> -->
echo '<h2 class="header"> Board Of Govenors </h2>';
//<!-- <div class="row governors"> -->
$findrecords = "select * from members, officersboard " .
"Where (`members`.`member_id` = `officersboard`.`member_id`) AND" .
" (year > '$yearfull') AND (`officersboard`.`type`='B');";
$result = _mysql_query($connection1, $findrecords);
//if query is successful display the vice president always use bold
if($result)
{
   while($row = _mysql_fetch_assoc($connection1, $result))
   {
      echo '<div class="row governors">';
      echo '<div class="col-md-3 col-md-offset-4 col-xs-7 col-xs-offset-0 string">';
      displayFullName($row);
      echo '</div><div class="col-md-3 col-xs-2 string">';
      displayCallAndQRZLink($row);
      echo '</div>';
      echo '</div>';
   }
}
//<!-- </div> -->
echo '<h2 class="header"> List of Members';
//show the sort button to show the option for sort by last name
//or suffix depending on what will load now
if( ! empty($_GET["sort"]))
{
   //the current is sorted by call suffix
   //display a button to change to last name order
   echo ' (<a href="#/members">Order By Name</a>)';
}
else
{
   //the current is sorted by last name
   echo ' (<a href="#/membersbycall">Order By Call</a>)';
}
echo '</h2>';
//<!-- <div class="row memberlist"> -->
//run the query to get the current membership
//get the tag to see if we are sorting by member name or
//call sign
if( ! empty($_GET["sort"]))
{
   $findrecords = "SELECT *
     , SUBSTRING(fcccall
       , LEAST(
          if (Locate('0',fcccall) >0,Locate('0',fcccall),99),
          if (Locate('1',fcccall) >0,Locate('1',fcccall),99),
          if (Locate('2',fcccall) >0,Locate('2',fcccall),99),
          if (Locate('3',fcccall) >0,Locate('3',fcccall),99),
          if (Locate('4',fcccall) >0,Locate('4',fcccall),99),
          if (Locate('5',fcccall) >0,Locate('5',fcccall),99),
          if (Locate('6',fcccall) >0,Locate('6',fcccall),99),
          if (Locate('7',fcccall) >0,Locate('7',fcccall),99),
          if (Locate('8',fcccall) >0,Locate('8',fcccall),99),
          if (Locate('9',fcccall) >0,Locate('9',fcccall),99)
         )+1,3
       ) AS fccsuffix " .
   "FROM members, paid " .
   "Where (`members`.`member_id` = `paid`.`member_id`) AND " .
   "(year > '$yearfull') " .
   "ORDER BY (CASE WHEN fcccall IS NULL THEN 1 ELSE 0 END) ASC" .
   ",(CASE WHEN SUBSTRING(fcccall,1,1) = ' ' THEN 1 ELSE 0 END) ASC," .
   " fccsuffix, lname, fname;";
   //echo $findrecords . '<br>';
}
//otherwise do the default
else
{
   $findrecords = "select * from members, paid " .
   "Where (`members`.`member_id` = `paid`.`member_id`) AND " .
   "(year > '$yearfull') " .
   "ORDER BY lname, fname, fcccall";
}
$result = _mysql_query($connection1, $findrecords);
//if query is successful display the member list
//use bold type for current paid memmbers based on the expiration
//date in the database
if($result)
{
   while($row = _mysql_fetch_assoc($connection1, $result))
   {
      //$datenow = time();
      $current = 'current';
      echo '<div class="row memberlist">';
      echo '<div class="col-md-3 col-md-offset-3 col-xs-4 col-xs-offset-0 string ' . $current . '">';
      displayFullName($row);
      echo '</div><div class="col-md-2 col-xs-3 ' . $current . '">';
      displayMemberIcon($row);
      echo '</div><div class="col-md-2 col-xs-3 col-xs-offset-1 string ' . $current . '">';
      displayCallAndQRZLink($row);
      echo '</div>';
      echo '</div>';
   }//end while
}//end if
?>
           <!-- </div> -->
        </body>
    </html>