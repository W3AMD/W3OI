<center>
<h1>LVARC VE Test Sessions</h1>
<hr width="50%">
<h2>* * * * Preregistered Applicants ONLY! * * * *</h2>
e-Mail <a href="mailto:ak3m@rcn.com">Mark Miller</a>, AK3M, for Preregistration<br>
or call at (610) 865-9183<br>
You <b>MUST</b> preregister at least 5 days before the session.<br>
Sessions without registrants will be canceled.
<hr width="25%">
</center>
<center><table>
<tbody><tr><td width="25%"></td><td><b>To test, you will need:</b></td><td>
</td></tr><tr><td width="25%"></td><td><ul>
<li>A <b>COPY</b> of your amateur license which will not be returned<br>
</li><li>Two forms of ID<br>
</li><li> 2 Pencils w/erasers
</li><li>$15.00 Testing Fee (Exact Cash Only)<br>Should you not pass, another version of the test may be <br>taken at the same sitting for an additional $15.00 fee.
</li></ul>
</td></tr>
<tr><td width="25%"></td><td><b>You may also bring:</b>
</td></tr><tr><td width="25%"></td><td><ul>
<li> Calculator<br>No formula(e) may be stored in memory.<br>The VE team reserves the right to check calculators for compliance.
</li></ul>
</td></tr>
</tbody></table></center>
<center>
<hr width="50%">
<table width="80%">

<tbody><tr><th colspan="4">2016 VE Testing Sessions<br>
3rd Friday of the Month, 6:30 PM at<br>
Hanover Elementary School, 3890 Jacksonville Road, Bethlehem, 18017-9307<br>
<a href="https://maps.google.com/maps?oe=utf-8&amp;client=firefox-a&amp;q=3890+Jacksonville+Road,+Bethlehem,+18017-9307&amp;ie=UTF-8&amp;hq=&amp;hnear=0x89c43f625e66e4a3:0x5c4f0615e467be75,3890+Jacksonville+Rd,+Bethlehem,+PA+18017&amp;gl=us&amp;ei=v2CUUfm6GtO54AOZvICABQ&amp;ved=0CC8Q8gEwAA"> (MAP) </a><br>
No test sessions in June or July<br>
</th></tr>
<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers And KC3ASC Igor Kasriel

//this script gets the ve testing dates from the
//database and displays them to the screen
//which is anything after or including the current date

//see lvarc.css for visual display and orientation classes
include('../includes/sqlfunctions.inc.php');
include('../includes/connection.inc.php');

echo '<b>2016 Test Schedule</b>';
$connection1 = dbConnect();
//run the query to get the current officers
$findrecords = "select * from vetesting WHERE testdate >= '" . date("m/d/Y") . "'";
$result = _mysql_query($connection1, $findrecords);
while($row = _mysql_fetch_assoc($connection1, $result))
{
   echo '<li>' . date("F d", strtotime($row['testdate'])) . " " . $row['comment'] . '<BR>';
   echo '</li>';
}
?>
</p>
</td></tr></tbody></table>
* - NOTE: 5th Friday!!!

<hr width="90%">
</center><?php

?>