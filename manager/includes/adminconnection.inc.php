<?php
function dbConnect() {
	// $hostname='108.2.206.24:3306';
	// $dbname='lvarcftp_test';
	// $user = 'lvarcftp_mgr';
	// $pwd = 'eyma2mFACJO9';

	$hostname='198.71.227.91:3306';
	$dbname='W3OI';
	$user = 'w3oiuser';
	$pwd = '146.94';

	// Connection code
	$conn = mysqli_connect( $hostname, $user, $pwd, $dbname ); // or die ( 'Cannot connect to MySQL server' );
	//mysql_select_db( $dbname ) or die ( 'Cannot open database' );
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL server: " . mysqli_connect_error();
	}
	return $conn;
}
?>