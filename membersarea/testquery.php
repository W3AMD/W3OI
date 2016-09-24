<?php require_once('../Connections/W3OITesting.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
        try {
            mysql_select_db($database_W3OITesting, $W3OITesting);
            $query_Recordset1 = "SELECT lname, fname, suffix,                 `members`.member_id , `family`.member_id " .
                 "FROM members, family " .
                 "WHERE (`members`.member_id = `family`.member_id " .
                 "AND `members`.member_id = 398)";
            echo $query_Recordset1. "<br>";
			$Recordset1 = mysql_query($query_Recordset1, $W3OITesting);
            $row_Recordset1 = mysql_fetch_assoc($Recordset1);
            $totalRows_Recordset1 = mysql_num_rows($Recordset1);
            echo $totalRows_Recordset1 . "<br>";
			echo "$key => $value";
            if($totalRows_Recordset1==FALSE) {
			  echo " Error - " . $row_Recordset1['lname'];
            }
			if($totalRows_Recordset1!=0) {
			  echo " - A Family";
             } else { 
			  echo " - Individual";
			 }
            echo "<br>";
		}
        catch(Exception $e)
         {
          echo "Exception: $e";
		  die();
         }
?>
</body>
</html>
