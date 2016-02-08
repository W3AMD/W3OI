<style type="text/css">

  .photo {
    float: left;
    margin: 0.5em;
    border: 1px solid #ccc;
    padding: 1em;
    font-size: 10px;
  }

</style>
<?PHP
// filetypes to display
$imagetypes = array("image/jpeg", "image/gif", "image/png");
?>
<?PHP
function getImages($dir)
{
   global $imagetypes;

   // array to hold return value
   $retval = array();
   // full server path to directory
   $fulldir = "{$_SERVER['DOCUMENT_ROOT']}$dir";
   $d = @dir($fulldir) or die("getImages: Failed opening directory $dir for reading");
   while(false !== ($entry = $d->read()))
   {
      // skip hidden files
      if($entry[0] == ".")
         continue;

      // check for image files
      $f = escapeshellarg("$fulldir$entry");
      $retval[] = array(
                        'file'=>"/members/images/large/$entry",
                        'size'=>getimagesize("$fulldir/$entry"));
   }
   $d->close();
   return $retval;
}
?>
<?PHP
// fetch image details
$images = getImages("\members\images\large");

// display on page
foreach($images as $img)
{
   echo "<div class=\"photo\">";
   echo "<img src=\"{$img['file']}\" width='200' height='auto' alt=\"\"><br>\n";
   // display image file name as link
   echo "<a href=\"{$img['file']}\">", basename($img['file']), "</a><br>\n";
   // display image dimenstions
   echo "({$img['size'][0]} x {$img['size'][1]} pixels)<br>\n";
   // display mime_type
   echo $img['size']['mime'];
   echo "</div>\n";
}
?>