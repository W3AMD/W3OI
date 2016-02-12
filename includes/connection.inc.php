<?php
//check the version to be capable with the function calls this is global
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

   $hostname = '198.71.227.91:3306';
   $dbname = 'W3OI';
   $user = 'w3oiuser';
   $pwd = '146.94';

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
}
?>