<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_W3OITesting = "localhost:3306";
$database_W3OITesting = "lvarcftp_w3oi";
$username_W3OITesting = "lvarcftp";
$password_W3OITesting = "g3r!nTaq$";
$W3OITesting = mysql_pconnect($hostname_W3OITesting, $username_W3OITesting, $password_W3OITesting) or trigger_error(mysql_error(),E_USER_ERROR); 
?>