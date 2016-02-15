<?php
include('includes/corefuncs.inc.php');
include('../includes/sqlfunctions.inc.php');
include('../includes/connection.inc.php');
if(function_exists('nukeMagicQuotes'))
{
   nukeMagicQuotes();
}
$conn = dbConnect();
$sql = 'SELECT * FROM announcements WHERE active = "1" ORDER BY displayorder, enddate';
$result = _mysql_query($conn, $sql);
$strReturn = '';
while($row = _mysql_fetch_assoc($conn, $result))
{
   $strReturn .= '<tr><td><div class="plaintext">' . $row['description'] . '</div></td><td style="text-align: right; padding-right: 50px;">' . $row['displayorder'] . '</td><td>' . $row['startdate'] . '</td><td>' . $row['enddate'] . '</td><td style="text-align: right;"><a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" href="#" role="button" disabled="false" id="edit' . $row['id'] . '" onclick="javascript:msgedit(\'' . $row['id'] . '\'); return false;"><span class="ui-button-text">Edit</span></a> <a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" href="#" role="button" disabled="false" id="del' . $row['id'] . '" onclick="javascript:msgdelete(\'' . $row['id'] . '\'); return false;"><span class="ui-button-text">Delete</span></a></td></tr>';
   // $strReturn .= '<tr><td><div class="plaintext">'.$row['description'].'</div></td><td style="text-align: right; padding-right: 50px;">'.$row['displayorder'].'</td><td>'.$row['startdate'].'</td><td>'.$row['enddate'].'</td><td style="text-align: right;"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="edit'.$row['id'].'" ng-click="msgedit(\''.$row['id'].'\');"><span class="ui-button-text">Edit</span></button> <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" id="del'.$row['id'].'" ng-click="msgdelete(\''.$row['id'].'\');"><span class="ui-button-text">Delete</span></button></td></tr>';
}

print ($strReturn);

?>