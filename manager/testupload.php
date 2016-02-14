<!DOCTYPE html>
<html>
<body>

<form action="testupload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
<?php
// Check if image file is a actual image or fake image
if(isset($_POST["submit"]))
{
   $target_dir = "uploads/";
   $target_file = $target_dir . $_FILES["fileToUpload"]["name"];
   $uploadOk = 1;
   $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
   echo 'Server version: ' . phpversion() . '<BR>';
   echo 'Selected tmp file for upload:' . $_FILES["fileToUpload"]["tmp_name"] . '<BR>';
   echo 'Selected file for upload:' . $_FILES["fileToUpload"]["name"] . '<BR>';
   echo 'Path info: ' . $imageFileType . '<BR>';
   echo 'Temp file: ' . $_FILES["fileToUpload"]["tmp_name"] . '<BR>';
   echo 'Root: ' . $_SERVER['DOCUMENT_ROOT'] . '<BR><BR>';
   $target_file/*$_SERVER['DOCUMENT_ROOT'] . */ = '..\upload\test.txt';
   echo 'Target file: ' . $target_file . '<BR><BR>';
   // Check if file already exists
   if(file_exists($target_file))
   {
      echo "Sorry, file already exists.<BR>";
      $uploadOk = 0;
   }
   // Check file size
   if($_FILES["fileToUpload"]["size"] > 5000000)
   {
      echo "Sorry, your file is too large.<BR>";
      $uploadOk = 0;
   }
   /*
   // Allow certain file formats
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif")
   {
   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   $uploadOk = 0;
   }
   */
   // Check if $uploadOk is set to 0 by an error
   if($uploadOk == 0)
   {
      echo "Sorry, your file was not uploaded.<BR>";
      // if everything is ok, try to upload file
   }
   else
   {
      //test
      $myfile = @fopen($_FILES["fileToUpload"]["tmp_name"], "r");
      if($myfile)
      {
         $data = @fread($myfile, 100000);
         fclose($myfile);
         echo 'successful read of temp file 100000 bytes <BR>';
      }
      else
      {
         print_r(error_get_last());
      }
      $myfile2 = @fopen('newfile.txt', "w");
      if($myfile2)
      {
         $txt = "John Doe\n";
         fwrite($myfile2, $txt);
         $txt = "Jane Doe\n";
         fwrite($myfile2, $txt);
         fclose($myfile2);
      }
      else
      {
         print_r(error_get_last());
         echo '<BR>';
      }
      if(@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
      {
         echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.<BR>";
      }
      else
      {
         echo "Sorry, there was an error uploading your file.<BR>";
         print_r(error_get_last());
         echo '<BR>';
      }
   }
}
?>