<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers And KC3ASC Igor Kasriel

//see lvarc.css for visual display and orientation classes

include('../layout/modalimages.inc.php');

function listFolderFiles($dir, $currentdir, $imagefiles)
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

            // echo '<a href="' . $pathfile . '" width=900 height=600 alt="" border="0" class="lytebox" data-lyte-options="group:' . $currentdir . '">';
            // echo '<span style="width: 180px; height: 180px; padding: 10px;">';
            // echo '<img src="' . $previewfile . '" alt="" border="0">';
            // echo '<span></a>';

            // echo '<div><span>' . $pathfile . '</span> : ';
            // echo '<span>' . $previewfile . '</span></div>';

            $currentimage[] = array('url' => "$pathfile" ,'thumbUrl' => "$previewfile");

            array_push($imagefiles, $pathfile, $previewfile);
         }
         else if(is_dir($dir . '/' . $ff))
         {
            // echo '<div class="event_name">' . $ff . '</div>';
            // echo '<ul>';
            listFolderFiles($dir . '/' . $ff, $ff, $imagefiles);
            // echo '</ul>';
         }
      }
   }
}

//create an array and search for vox issues
//the array stores the date of the issue from the month/year in the file

$imagefiles = array();
$imagefiles = listFolderFiles('../clubphotos', NULL, $imagefiles);
// echo $imagefiles;
// echo json_encode($imagefiles);

while(count($imagefiles))
{
   foreach($imagefiles as $k=>$v)
   {
      $pathkey = $k + 1;
      echo '<div>' . $pathkey . '</div>';
      echo '<div>' . $imagefiles[$pathkey] . '</div>';
   }
}
?>