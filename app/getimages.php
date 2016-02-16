<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers And KC3ASC Igor Kasriel

//see lvarc.css for visual display and orientation classes

class Img {
   public $url = "";
   public $thumbUrl = "";
}

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

            // echo '<a href="' . $pathfile . '" width=900 height=600 alt="" border="0" class="lytebox" data-lyte-options="group:' . $currentdir . '">';
            // echo '<span style="width: 180px; height: 180px; padding: 10px;">';
            // echo '<img src="' . $previewfile . '" alt="" border="0">';
            // echo '<span></a>';

            $currentimage = new Img();
            $currentimage->url = $pathfile;
            $currentimage->thumbUrl = $previewfile;

            array_push($imagefiles, $currentimage);
         }
         else if(is_dir($dir . '/' . $ff))
         {
            // echo '<div class="event_name">' . $ff . '</div>';
            // echo '<ul>';
            $imagefiles = listFolderFiles($dir . '/' . $ff, $ff, $imagefiles);
            // echo '</ul>';
         }
      }
   }
   return $imagefiles;
}

$imagefiles = array();
$imagefiles = listFolderFiles('../clubphotos', NULL, $imagefiles);
echo json_encode($imagefiles);

?>