<?php
function listFolderFiles($dir, $currentdir)
{
   $ffs = scandir($dir);
   foreach($ffs as $ff)
   {
      if($ff != '.' && $ff != '..')
      {
         if(is_dir($dir . '/' . $ff))
         {
            echo '<div class="document_folder">'. ucfirst ($ff) . '</div>';
         }
         else
         {
            echo '<div class="document"><a href="../documents/' . $currentdir .'/' .
            $ff . '">' . $ff . '</a></div>';
         }
         if(is_dir($dir . '/' . $ff))
            listFolderFiles($dir . '/' . $ff, $ff);
      }
   }
}

listFolderFiles('../documents/', NULL);
?>
