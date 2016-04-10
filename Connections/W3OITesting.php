<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_W3OITesting = "198.71.227.91:3306";
$database_W3OITesting = "w3oiworkinprog";
$username_W3OITesting = "server";
$password_W3OITesting = "R3spe4%6";
$W3OITesting = mysql_pconnect($hostname_W3OITesting, $username_W3OITesting, $password_W3OITesting) or trigger_error(mysql_error(),E_USER_ERROR); 
?>