<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers And KC3ASC Igor Kasriel
function dbConnect()
{
   // $hostname='108.2.206.24:3306';
   // $dbname='lvarcftp_test';
   // $user = 'lvarcftp_test';
   // $pwd = 'RW22qhHO62HO';

   $hostname = '198.71.227.91:3306';
   $dbname = 'w3oiworkinprog';
   $user = 'server';
   $pwd = 'bV34ne3&';

   // Connection code
   $conn = _mysql_connect($hostname, $user, $pwd);
   if( ! $conn)
   {
      header("Location: /unavailable.html");
      exit;
   }
   _mysql_select_db($conn, $dbname);
   return $conn;
}

function dbConnectOtherUsers($username,$password)
{
   // $hostname='108.2.206.24:3306';
   // $dbname='lvarcftp_test';
   // $user = 'lvarcftp_test';
   // $pwd = 'RW22qhHO62HO';

   $hostname = '198.71.227.91:3306';
   $dbname = 'w3oiworkinprog';

   // Connection code
   $conn = _mysql_connect($hostname, $username, $password);
   return $conn;
}
?>