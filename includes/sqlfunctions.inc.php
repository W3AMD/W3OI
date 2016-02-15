<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers And KC3ASC Igor Kasriel
//check the version to be capable with the function calls
function check_sql_version()
{
   $version = phpversion();
   $oldmysql = version_compare($version, '5.5.0');
   if($oldmysql < 0)
   {
      $oldmysql = TRUE;
   }
   else
   {
      $oldmysql = FALSE;
   }
   return $oldmysql;
}

function _mysql_connect($hostname, $user, $pwd)
{
   //don't die on connection error if user enters wrong password
   if(check_sql_version())
   {
      $conn = @mysql_connect($hostname, $user, $pwd);
   }
   else
   {
      $conn = @mysqli_connect($hostname, $user, $pwd);
   }
   return $conn;
}
function _mysql_select_db($connection, $dbname)
{
   if(check_sql_version())
   {
      mysql_select_db($dbname) or
      die('mysql_select_db: Cannot select database');
   }
   else
   {
      mysqli_select_db($connection, $dbname) or
      die('mysqli_select_db: Cannot select database');
   }
}

function _mysql_query($connection, $findrecords)
{
   if(check_sql_version())
   {
      $result = mysql_query($findrecords);
   }
   else
   {
      $result = mysqli_query($connection, $findrecords);
   }
   if( ! $result)
   {
      die('Invalid query: ' . (check_sql_version())? mysql_error(): mysqli_error());
   }
   return $result;
}

function _mysql_fetch_assoc($connection, $result)
{
   if(check_sql_version())
   {
      $row = mysql_fetch_assoc($result);
   }
   else
   {
      $row = mysqli_fetch_assoc($result);
   }
   return $row;
}
?>