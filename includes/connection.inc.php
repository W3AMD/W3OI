<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers And KC3ASC Igor Kasriel
function dbConnect()
{
   // Production info
   $hostname='localhost:3306';
   $dbname='lvarcftp_w3oi';
   $user = 'lvarcftp_w3oiusr';
   $pwd = 'kzWwv_lMPLo@';

   // Development info
   // $hostname = '198.71.227.91:3306';
   // $dbname = 'W3OI';
   // $user = 'w3oiuser';
   // $pwd = '146.94';

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

   $hostname = 'localhost:3306';
   $dbname = 'lvarcftp_w3oi';

   // Connection code
   $conn = _mysql_connect($hostname, $username, $password);
   return $conn;
}
?>