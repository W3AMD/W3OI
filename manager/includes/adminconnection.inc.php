<?php
//check the version to be capable with the function calls
function getdbVersion()
{
   $version = phpversion();
   $oldphp = version_compare($version, '5.5.0');
   if($oldphp < 0)
   {
      $oldphp = TRUE;
   }
   else
   {
      $oldphp = FALSE;
   }
   return $oldphp;
}

function dbConnect()
{
   // $hostname='108.2.206.24:3306';
   // $dbname='lvarcftp_test';
   // $user = 'lvarcftp_test';
   // $pwd = 'RW22qhHO62HO';

   $hostname = 'localhost:3306';
   $dbname = 'lvarcftp_w3oi';
   $user = 'lvarcftp_w3oimgr';
   $pwd = '6JMw&eU]7CVr';

   $oldphp = getdbVersion();

   // Connection code
   //$conn = mysql_connect( $hostname, $user, $pwd ) or die ( 'Cannot connect to MySQL server' );
   if($oldphp)
   {
      $conn = mysql_connect($hostname, $user, $pwd) or die('Cannot connect to MySQL server');
   }
   else
   {
      $conn = mysqli_connect($hostname, $user, $pwd) or die('Cannot connect to MySQL server');;
   }
   //mysql_select_db( $dbname ) or die ( 'Cannot open database' );
   if($oldphp)
   {
      mysql_select_db($dbname) or die('Cannot open database');
   }
   else
   {
      mysqli_select_db($dbname) or die('Cannot open database');
   }
   return $conn;
}?>