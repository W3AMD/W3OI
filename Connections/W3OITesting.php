<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//108.2.206.24 or local

  //original (from John's Dreamweaver connection)
   $hostname_W3OITesting = "localhost:3306";
   $database_W3OITesting = "lvarcftp_w3oi";
   $username_W3OITesting = "lvarcftp";
   $password_W3OITesting = "g3r!nTaq$";

  // Production info
   //$hostname_W3OITesting='localhost:3306';
   //$database_W3OITesting='lvarcftp_w3oi';
   //$username_W3OITesting = 'lvarcftp_w3oiusr';
   //$password_W3OITesting = 'kzWwv_lMPLo@';

  // Development info
   // $hostname = '198.71.227.91:3306';
   // $dbname = 'W3OI';
   // $user = 'w3oiuser';
   // $pwd = '146.94';


$W3OITesting = mysql_pconnect($hostname_W3OITesting, $username_W3OITesting, $password_W3OITesting) or trigger_error(mysql_error(),E_USER_ERROR);
?>