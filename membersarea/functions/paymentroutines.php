<?php
//this function will add payment information for the selected member ID
//it determines if the member is part of a family and then adds the payment type
function AddPayment ($member_id,$type,$W3OIDB) {
	 //add the payment information
	 //if it's before Oct 1 (the cutoff date) the member is for this year
	 //otherwise it's for next year
	 $checkmonth=date('m');
	 if($checkmonth>=10) {
	   //echo "After October payments are for next year.<br>";
	   $paymentyear=date('Y', strtotime('+1 year')) . "-12-31";
	  }
	 else {
	   //echo "Before October payment is for this year.<br>";
	   $paymentyear=date('Y') . "-12-31";
	 }
	//check if a payment record already exists for this year
	$query_Recordset2 = "SELECT * From paid where member_id = " .
	$member_id/*GetSQLValueString($_POST['member_id'], "int")*/ . " AND year = '" .
	$paymentyear . "'";
	$Recordset2 = mysql_query($query_Recordset2, $W3OIDB) or die(mysql_error());
	$totalRows_Recordset2 = mysql_num_rows($Recordset2);
	if($totalRows_Recordset2>0) {
		echo "Payment information already exists for $paymentyear!<br>";
	}
	else {
	  //check if this member is part of a family if so update all family members payments
	  //run the query to find out if this member is in a family
	  $query_Recordset2 = "SELECT * From family where member_id = " .
	  $member_id/*GetSQLValueString($_POST['member_id'], "int")*/;
	  $Recordset2 = mysql_query($query_Recordset2, $W3OIDB) or die(mysql_error());
	  $totalRows_Recordset2 = mysql_num_rows($Recordset2);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
	  $familyid = $row_Recordset2['family_id'];
	  if($totalRows_Recordset2>0) {
		//this member is part of a family so we'll need to update all the payment records
		//for the family
		//first check if the payment type is correct, it should be 'F' for family
		if($type!='F') {
			echo "Error, This member is part of family but you didn't select family for payment type.<br>";
			}
		else {
			echo "This member is part of family with ID: $familyid<br>";
			$query_Recordset2 = "SELECT * From family where family_id = " . GetSQLValueString($familyid, "int");
			$Recordset2 = mysql_query($query_Recordset2, $W3OIDB) or die(mysql_error());
			while ($row = mysql_fetch_array($Recordset2, MYSQL_ASSOC)) {
				$memberid = $row['member_id'];
				//finally insert the payment record
				$query_Recordset2 = "INSERT INTO paid (paid_id, member_id, year, type) VALUES (NULL," . 
					GetSQLValueString($memberid, "int") . ", '$paymentyear', '$type')";
				mysql_query($query_Recordset2, $W3OIDB) or die(mysql_error());
				echo "Payment information updated for $memberid!<br>";
			  }
		  }
	   }
	  else {
		//finally insert the payment record
		$query_Recordset2 = "INSERT INTO paid (paid_id, member_id, year, type) VALUES (NULL," . 
		GetSQLValueString($_POST['member_id'], "int") . ", '$paymentyear', '$type')";
		mysql_query($query_Recordset2, $W3OIDB) or die(mysql_error());
		echo "Payment information updated!<br>";
	  }
	}
 }
?>
