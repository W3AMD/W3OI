<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers And KC3ASC Igor Kasriel

//this file is the get newsletters script which will get the files
//from the newsletter directory and dsplay them to the screen output
//it goes through all the subfolders of dates and sorts them in reverse order
//the directory name does not matter but the file naming itself does
//this is where the screen display will get it's actual information from
//and the directory numbering of the years is just for clarity

//see lvarc.css for visual display and orientation classes

function listFolderFiles($dir, $currentdir, $dateandfile)
{
   $ffs = scandir($dir);
   foreach($ffs as $ff)
   {
      if($ff != '.' && $ff != '..')
      {
         if( ! is_dir($dir . '/' . $ff))
         {
            $day = '01';
            $month = substr($ff, 0, 3);
            $year = substr($ff, 3, 2);
            $time = strtotime($day . $month . $year);
            $pathfile = '../newsletter/' . $currentdir . '/' . $ff;
            array_push($dateandfile, $time, $pathfile);
         }
         if(is_dir($dir . '/' . $ff))
            $dateandfile = listFolderFiles($dir . '/' . $ff, $ff, $dateandfile);
      }
   }
   return $dateandfile;
}

//create an array and search for vox issues
//the array stores the date of the issue from the month/year in the file

$dateandfile = array();
$dateandfile = listFolderFiles('../newsletter/', NULL, $dateandfile);
$currentyear = 0;
while(count($dateandfile))
{
   //find the newest VOX issue date in the array
   $maxdate = 0;
   foreach($dateandfile as $k=>$v)
   {
      if($v > $maxdate)
         $maxdate = $v;
   }

   //maxdate now how the newest VOX issue date
   //loop through the array finding the newest issue date
   //display that issue to the window with it's link
   //remove the value from the array
   //and repeat until the array is empty
   foreach($dateandfile as $k=>$v)
   {
      $pathkey = $k + 1;
      if($v == $maxdate)
      {
         //found the largest date record
         //check if this is the same year
         $thisyear=idate('Y',$maxdate);
         if($currentyear != $thisyear)
         {
            //start a sub list
            //only if this is not the first time close the last list
            if($currentyear!=0)
               echo '</ul>';
            echo '<ul><div class="newsletter_year">' . $thisyear . '</div>';
            //update the current year
            $currentyear = $thisyear;
         }
         $dateandfile[$pathkey] . '</p></h1>';
         echo '<li class="newsletter">' . '<a href="' . $dateandfile[$pathkey] . '" target="_blank">' .
         date('F', $v) . '</a></li>';
         //remove this from the array
         unset($dateandfile[$k]);
         unset($dateandfile[$pathkey]);
         //leave loop because already found max
         break;
      }
   }
}

//use the array to find the largest date

/*

$sourcedir = "../newsletter/";
$fileExt = "pdf";
$request = $_SERVER['REQUEST_URI'];
$endreq = strrpos($request,'/');
$url = substr($request, 0, $endreq);

$dir = opendir($sourcedir);

$strReturned = '<ul>';

while ( false !== ( $file = readdir($dir) ) )
{
	// if ( substr_compare($file, $fileExt, -3, 3) )
	if ($file != "." && $file != ".." && $file != "images")
	{
		$strReturned .= "<li><a href='$url/$sourcedir$file' target='_blank'>$file</a></li>";
	}
}

$strReturned .= '</ul>';
closedir($dir);

print($strReturned);
*/
?>