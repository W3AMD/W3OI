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
            echo '<BR><p>'. ucfirst ($ff) . '</p>';
         }
         else
         {
            echo '<a href="../documents/' . $currentdir .'/' .
            $ff . '">' . $ff . '</a>' . '<BR>';
         }
         if(is_dir($dir . '/' . $ff))
            listFolderFiles($dir . '/' . $ff, $ff);
      }
   }
}

listFolderFiles('../documents/', NULL);
?>
