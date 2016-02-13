<?php
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
   $dbname = 'W3OI';

   // Connection code
   $conn = _mysql_connect($hostname, $username, $password);
   return $conn;
}
?>