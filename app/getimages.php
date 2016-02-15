<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers And KC3ASC Igor Kasriel

//see lvarc.css for visual display and orientation classes

include('../layout/modalimages.inc.php');

function listFolderFiles($dir, $currentdir)
{
   $ffs = scandir($dir);
   foreach($ffs as $ff)
   {
      if($ff != '.' && $ff != '..' && $ff != 'PREVIEWS')
      {
         if( ! is_dir($dir . '/' . $ff))
         {
            $pathfile = 'clubphotos/' . $currentdir . '/' . $ff;
            $previewfile = 'clubphotos/' . $currentdir . '/PREVIEWS/' . $ff;
            // echo '<li class="event_image">' . '<a href="' . $pathfile . '" target="_blank">' . $ff . '</a></li>';

            echo '<a href="' . $pathfile . '" width=900 height=600 alt="" border="0" class="lytebox" data-lyte-options="group:' . $currentdir . '">';
            echo '<span style="width: 180px; height: 180px; padding: 10px;">';
            echo '<img src="' . $previewfile . '" alt="" border="0">';
            echo '<span></a>';

            // array_push($dateandfile, $pathfile);
         }
         else if(is_dir($dir . '/' . $ff))
         {
            echo '<div class="event_name">' . $ff . '</div>';
            echo '<ul>';
            listFolderFiles($dir . '/' . $ff, $ff);
            echo '</ul>';
         }
      }
   }
}

//create an array and search for vox issues
//the array stores the date of the issue from the month/year in the file

listFolderFiles('../clubphotos', NULL);

?>