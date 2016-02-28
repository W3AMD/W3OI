<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("comctrls.inc.php");
include('../includes/sqlfunctions.inc.php');
include('../includes/connection.inc.php');

//Class definition
class DatabaseSync extends Page
{
   public $CallsignCheck = null;
   public $SyncProgress = null;
   public $Upload1 = null;
   public $Label1 = null;
   public $UploadSync = null;
   public $UploadStatus = null;
   function UploadSyncClick($sender, $params)
   {
      //upload the file
      //test if the working directory exists
      $dir = 'dbsync';
      if( ! is_dir($dir))
      {
         //create the directory
         $this->UploadStatus->Caption = 'Directory ' . $dir .
         ' does not exist. Creating.';
         mkdir($dir);
      }
      //upload the file
      $uploaddoc = $dir . '/' . $this->Upload1->FileName;
      if(@move_uploaded_file($this->Upload1->FileTmpName, $uploaddoc))
      {
         //show success to the user
         $this->UploadStatus->Font->Color = Green;
         $this->UploadStatus->Caption = 'Upload successful.';
      }
      else
      {
         //exit on failure
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption = 'Upload failure.';
         return;
      }
      //stage 1
      //parse the file
      //create the working file on the server
      //add the database to be using
      //show progress to the user as we go along
      try
      {
         $this->UploadStatus->Caption = 'Parsing file.';
         //create the work file
         $sqlworkingfile = fopen($dir . '/uploadsync.sql', "w");
         $sqluploadedfile = fopen($uploaddoc, "r");
         //get the number of lines in the file
         $numorginallines = count(file($uploaddoc));
         //set the progress bar to the max count of the lines
         $this->SyncProgress->Max = $numorginallines;
         //loop through the lines from the uploaded file
         for($x = 0; $x <= $numorginallines; $x++)
         {
            $line = fgets($sqluploadedfile);
            //remove the comment lines
            //test for the following
            //comment lines beginning with /* AND
            //comment lines beginning with --
            $findcomment1 = strpos($line, '/*');
            $findcomment2 = strpos($line, '--');
            if(($findcomment1 === false) && ($findcomment2 === false))
            {
               //if this line doesn't have these comments write to the
               //sql command temp file
               fwrite($sqlworkingfile, $line);
            }
            $this->SyncProgress->Position = $x;
         }
         //close the original file and the working file since inside a try block
         fclose($sqluploadedfile);
         fclose($sqlworkingfile);
      }
      catch(Exception$e)
      {
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption = 'Trouble in stage 1.' . $e;
         return;
      }
      //stage 2
      //connect to the database
      $dbconnection = dbConnect();
      try
      {
         //for testing login previously required will handle this
         //copy the entire file into a query
         $sqlstatement = file_get_contents($dir . '/uploadsync.sql');
         //start a transaction (all or nothing change)
         $result = _mysql_begin_transaction($dbconnection, $param);
         _mysql_query($dbconnection, 'use W3OI;');
         $this->SyncProgress->Max = strlen($sqlstatement);
         while(strlen($sqlstatement) > 0)
         {
            //update the progress bar position
            $positionnow = $this->SyncProgress->Max -
            strlen($sqlstatement);
            $this->SyncProgress->Position = $positionnow;
            //break apart the sql commands
            $position = strpos($sqlstatement, ";\n");
            if($position === false)
            {
               break;
            }
            $sqlcommand = substr($sqlstatement, 0, $position + 1);
            //run the query
            $result = _mysql_query($dbconnection, $sqlcommand);
            //now strip this done command from the the sql statement
            $sqlstatement = substr($sqlstatement, $position + 1);
         }
         $this->UploadStatus->Caption = 'SQL statement update successful.';
         //end the transaction
         $result = _mysql_commit($dbconnection);

      }
      catch(Exception$e)
      {
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption = 'Trouble in stage 2. ' . $e;
         return;
      }

      //if the database has been successfully updated syncronize the data
      try
      {
         //delete the member table
         $sqlstatement = 'DROP TABLE IF EXISTS members;';
         $result = _mysql_query($dbconnection, $sqlstatement);
         //copy from the old style table
         $sqlstatement = 'CREATE TABLE members LIKE w3oi_mbr;';
         $result = _mysql_query($dbconnection, $sqlstatement);
         //insert members into the new table
         $sqlstatement = 'INSERT members SELECT * FROM w3oi_mbr;';
         $result = _mysql_query($dbconnection, $sqlstatement);
         //drop the unwanted columns
         $sqlstatement = 'ALTER TABLE `members`' .
         'DROP `pd00`,' .
         'DROP `pd01`,' .
         'DROP `pd02`,' .
         'DROP `pd03`,' .
         'DROP `pd04`,' .
         'DROP `pd05`,' .
         'DROP `pd06`,' .
         'DROP `pd07`,' .
         'DROP `pd08`,' .
         'DROP `pd09`,' .
         'DROP `pd10`,' .
         'DROP `pd11`,' .
         'DROP `pd12`,' .
         'DROP `pd13`,' .
         'DROP `pd14`,' .
         'DROP `pd15`,' .
         'DROP `pd16`,' .
         'DROP `pd17`,' .
         'DROP `pd18`,' .
         'DROP `pd19`,' .
         'DROP `bogpos`,' .
         'DROP `acode`,' .
         'DROP `xchg`,' .
         'DROP `fone`,' .
         'DROP `csz`,' .
         'DROP `cty_st`,' .
         'DROP `fullname`,' .
         'DROP `pid`,' .
         'DROP `expires`;';
         $result = _mysql_query($dbconnection, $sqlstatement);
         $sqlstatement = 'DELETE FROM `paid`;';
         $result = _mysql_query($dbconnection, $sqlstatement);
         $sqlstatement = 'INSERT paid SELECT (id AS member_id) FROM w3oi_mbr;';
         $result = _mysql_query($dbconnection, $sqlstatement);
         //check the board records
         //check the paid status

         $this->UploadStatus->Caption = 'SQL transfer successful.';
      }
      catch(Exception$e)
      {
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption = 'Trouble in stage 2. ' . $e;
         return;
      }

   }
}

global $application;

global $DatabaseSync;

//Creates the form
$DatabaseSync = new DatabaseSync($application);

//Read from resource file
$DatabaseSync->loadResource(__FILE__);

//Shows the form
$DatabaseSync->show();
/*save for later
while($row = _mysql_fetch_assoc($dbconnection, $result))
{
$recordarry = array(
"id"=>$row['id'],
"title"=>$row['title'],
"fname"=>$row['fname'],
"mid"=>$row['mid'],
"lname"=>$row['lname'],
"suffix"=>$row['suffix'],
"fcccall"=>$row['fcccall'],
"class"=>$row['class'],
"type"=>$row['type'],
"mail"=>$row['mail'],
"patch"=>$row['patch'],
"adial"=>$row['adial'],
"addr1"=>$row['addr1'],
"addr2"=>$row['addr2'],
"city"=>$row['city'],
"state"=>$row['state'],
"zip"=>$row['zip'],
"county"=>$row['county'],
"tag"=>$row['tag'],
"tag2"=>$row['tag2'],
"email"=>$row['email'],
"hfone"=>$row['hfone'],
"busfone"=>$row['busfone'],
"vox"=>$row['vox'],
"lastupdt"=>$row['lastupdt'],
"unlfone"=>$row['unlfone'],
"note"=>$row['note'],
"bdbdg"=>$row['bdbdg'],
"ndcard"=>$row['ndcard'],
"pd00"=>$row['pd00'],
"pd01"=>$row['pd01'],
"pd02"=>$row['pd02'],
"pd03"=>$row['pd03'],
"pd04"=>$row['pd04'],
"pd05"=>$row['pd05'],
"pd06"=>$row['pd06'],
"pd07"=>$row['pd07'],
"pd08"=>$row['pd08'],
"pd09"=>$row['pd09'],
"pd10"=>$row['pd10'],
"pd11"=>$row['pd11'],
"pd12"=>$row['pd12'],
"pd13"=>$row['pd13'],
"pd14"=>$row['pd14'],
"pd15"=>$row['pd15'],
"pd16"=>$row['pd16']);
*/
?>