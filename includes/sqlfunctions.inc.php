<?php
//check the version to be capable with the function calls
$version = phpversion();
global $oldmysql;
$oldmysql = version_compare($version, '5.5.0');
if($oldmysql < 0)
{
   $oldmysql = TRUE;
}
else
{
   $oldmysql = FALSE;
}
function _mysql_connect($hostname, $user, $pwd) {
if($oldmysql)
   {
      $conn = mysql_connect($hostname, $user, $pwd) or die('Cannot connect to MySQL server');
   }
   else
   {
      $conn = mysqli_connect($hostname, $user, $pwd) or die('Cannot connect to MySQL server');;
   }
}
function _mysql_select_db($connection,$dbname) {
  if($oldmysql)
   {
      mysql_select_db($dbname) or die('Cannot open database');
   }
   else
   {
      mysqli_select_db($connection,$dbname) or die('Cannot open database');
   }
}
?>