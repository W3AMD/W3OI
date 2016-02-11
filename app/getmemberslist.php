<style type="text/css">

/*  .memberIcon {
    background:#ffffff;
    float: center;
    margin: 5px;
    border: 2px solid #999999;
    padding: 5px;
    font-size: 3vw; /* 3% viewport width */
    text-align: center;
  }

  .memberList {
    font-size: 3vw; /* 3% viewport width */
    text-align: center;
  }

  p {
    font-size: 3vw; /* 3% viewport width */
    text-align: center;
  }

  body {
    font-size: 3vmw; /* 3% viewport width */
    text-align: center;
  }

  .memberpagetitles {
   text-align: center;
   }

  .marginOfficers {
   text-align: center;
  }

  .marginOfficersName {
   text-align: center;
  }
*/
</style>

<?php
//This code is copyright 2015 LVARC
//Author: John Borchers W3AMD

//function used to connect to the member database and return the connection
//information
// function dbConnectMembers()
// {
//    // $hostname='108.2.206.24:3306';
//    // $dbname='lvarcftp_test';
//    // $user = 'lvarcftp_test';
//    // $pwd = 'RW22qhHO62HO';

//    $hostname = '198.71.227.91:3306';
//    $dbname = 'W3OI';
//    $user = 'w3oiuser';
//    $pwd = '146.94';

//    // Connection code
//    $conn = mysqli_connect($hostname, $user, $pwd) or die('Cannot connect to W3OI database server');
//    //$conn = mysqli_connect( $hostname, $user, $pwd ) or die ( 'Cannot connect to MySQL server' );
//    mysqli_select_db($conn, $dbname) or die('Cannot open W3OI database');
//    //mysqli_select_db( $conn, $dbname ) or die ( 'Cannot open database' );
//    return $conn;
// }
include('../includes/corefuncs.inc.php');
include('../includes/connection.inc.php');

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
      $row['fcccall'] . "' target='_blank'>" . $callsign. "</a><br />";
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
   $fulldir = "{$_SERVER['DOCUMENT_ROOT']}" . '\members\images\thumbs\\';
   $exists = file_exists($fulldir . $callsign . ".jpg");
   //echo $fulldir . $callsign . '.jpg<br>';
   if($exists)
   {
      echo '<img src="/members/images/thumbs/' . $callsign .
      ".jpg\" width='100' height='auto' alt=\"\" class=\"memberIcon\">";
      /*
      // display image file name as link
      echo "<a href=\"{$img['file']}\">", basename($img['file']), "</a><br>\n";
      // display image dimenstions
      echo "({$img['size'][0]} x {$img['size'][1]} pixels)<br>\n";
      // display mime_type
      echo $img['size']['mime'];
      */
   }
}

//this function displays the members name and formats a space
//for the upcoming callsign to be displayed next
//it takes in the SQl query row from the membership database
function displayFullName($row)
{
   echo $row['fullname'] . " ";
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
<p><u><b> Officers For
<?php
echo date("Y");
?>
</p>
</div>
<div class="marginOfficers">
</u></b>
<?php
// $connection1 = dbConnectMembers();
$connection1 = dbConnect();
if( ! $connection1)
{
   header("Location: /unavailable.html");
   exit;
}
else
{
   //run the query to get the current officers
   $findrecords = "select * from memberlist WHERE ispresident = true";
   $result = mysqli_query($connection1, $findrecords);
   if( ! $result)
   {
      die('Invalid query: ' . mysql_error());
   }
   ?>
            <table><p>
  <?php
   //if query is successful display the president always use bold
   if($result)
   {
      while($row = mysqli_fetch_assoc($result))
      {
         displayStartTitleBold("President");
         displayFullName($row);
         displayCallAndQRZLink($row);
      }
      $findrecords = "select * from memberlist WHERE isvicepresident = true";
      $result = mysqli_query($connection1, $findrecords);
      if( ! $result)
      {
         die('Invalid query: ' . mysql_error());
      }
      //if query is successful display the vice president always use bold
      if($result)
      {
         while($row = mysqli_fetch_assoc($result))
         {
            displayStartTitleBold("Vice President");
            displayFullName($row);
            displayCallAndQRZLink($row);
         }
      }
      $findrecords = "select * from memberlist WHERE issecretary = true";
      $result = mysqli_query($connection1, $findrecords);
      if( ! $result)
      {
         die('Invalid query: ' . mysql_error());
      }
      //if query is successful display the secretary always use bold
      if($result)
      {
         while($row = mysqli_fetch_assoc($result))
         {
            displayStartTitleBold("Secretary");
            displayFullName($row);
            displayCallAndQRZLink($row);
         }
      }
      $findrecords = "select * from memberlist WHERE istreasurer = true";
      $result = mysqli_query($connection1, $findrecords);
      if( ! $result)
      {
         die('Invalid query: ' . mysql_error());
      }
      //if query is successful display the treasurer always use bold
      if($result)
      {
         while($row = mysqli_fetch_assoc($result))
         {
            displayStartTitleBold("Treasurer");
            displayFullName($row);
            displayCallAndQRZLink($row);
         }
      }
?>
            </table></p>
</div>
<p><b><u> Board Of Govenors </b></u></p>
<table><p>
<?php 
      $findrecords = "select * from memberlist WHERE isboardmember = true";
      $result = mysqli_query($connection1, $findrecords);
      if( ! $result)
      {
         die('Invalid query: ' . mysql_error());
      }
      //if query is successful display the vice president always use bold
      if($result)
      {
         while($row = mysqli_fetch_assoc($result))
         {
            displayFullName($row);
            displayCallAndQRZLink($row);
         }
      }
?>
</p></table>
<p><b><u> List of Members </b></u>
<?php
//show the sort button to show the option for sort by last name
//or suffix depending on what will load now
 if( ! empty($_GET["sort"])) {
 //the current is sorted by call suffix
 //display a button to change to last name order
 echo ' (<a href="#/members">Order By Name</a>)';
}
 else {
 //the current is sorted by last name
 echo ' (<a href="#/membersbycall">Order By Call</a>)';
 }
?>
</p><table> <p>
      <?php
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
       ) AS fccsuffix
 FROM memberlist
 ORDER BY (CASE WHEN fcccall IS NULL THEN 1 ELSE 0 END) ASC" .
         ",(CASE WHEN SUBSTRING(fcccall,1,1) = ' ' THEN 1 ELSE 0 END) ASC," .
         " fccsuffix, lastname, firstname";
      }
      //otherwise do the default
      else
      {
         $findrecords = "select * from memberlist ORDER BY lastname, firstname, fcccall";
      }
      $result = mysqli_query($connection1, $findrecords);
      if( ! $result)
      {
         die('Invalid query: ' . mysql_error());
      }

      //if query is successful display the member list
      //use bold type for current paid memmbers based on the expiration
      //date in the database
      if($result)
      {
         while($row = mysqli_fetch_assoc($result))
         {
            $datenow = time();
            $recorddate = strtotime($row['expires']);
            if($recorddate >= $datenow)
            {
               echo '<b>';
            }
            echo '<div class="memberList">';
            displayFullName($row);
            displayMemberIcon($row);
            displayCallAndQRZLink($row);
            echo '</div>';
            if($recorddate >= $datenow)
            {
               echo '</b>';
            }
         }
      }
   }
}
?>
           </p> </table>
        </body>
    </html>