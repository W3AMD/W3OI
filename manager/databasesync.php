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
      //parse the file
      //create the working file on the server
      //add the database to be using
      try
      {
         //create the work file
         $sqlworkingfile = fopen("uploadsync.sql", "w");
         $sqluploadedfile = fopen($uploaddoc, "r");
         //add the sql statement to use the w3oi database
         $usedb = 'use W3OI\n';
         //write this to the file
         fwrite($sqlworkingfile, $usedb);
         //get the number of lines in the file
         $numorginallines = count(file($uploaddoc));
         //set the progress bar to the max count of the lines
         $this->SyncProgress->Max = $numorginallines;
         //loop through the lines from the uploaded file
         for($x = 0; $x <= $numorginallines; $x++)
         {
            $line=fgets ($sqluploadedfile);
            $this->SyncProgress->Position = $x;
         }
         //remove the comment lines
         //test for the following
         //comment lines beginning with /*
         //comment lines beginning with --
      }
      catch(Exception$e)
      {
      }
      //show progress to the user as we go along
      //start a transaction (all or nothing change)
      //run the query
      //end the transaction
      //test success
      //if the database has been successfully updated syncronize the data
      //test members by callsign
      //update any non matching record
      //check the board records
      //check the paid status
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

?>