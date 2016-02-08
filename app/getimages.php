<?php

//$id = $_POST['id'];
$folder = $_GET['folder'];

$imagesdir = "./images/$folder";
$sourcedir = "events/images/$folder/";
$dir = opendir($imagesdir);

$strReturned = '<ul>';

while ( false !== ( $file = readdir($dir) ) )
{
	if ($file != "." && $file != ".." && $file != "images")
	{
		$displayname = substr($file, 0, -4);
		$strReturned .= "<li><a href='$sourcedir$file' width=900 height=600 alt='' border='0' class='lytebox' data-lyte-options='group:FishermansDay'><img src='$sourcedir$file' width=600 height=401 alt='' border='0'></a></li>";
	}
}

$strReturned .= '</ul>';
closedir($dir);

die($strReturned);

?>
