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
   public $SyncProgress = null;
   public $Upload1 = null;
   public $Label1 = null;
   public $UploadSync = null;
   public $UploadStatus = null;
   function UploadSyncClick($sender, $params)
   {
      //upload the file
      $dir = 'dbsync';
      if( ! is_dir($dir))
      {
         $this->UploadStatus->Caption = 'Directory ' . $dir .
         ' does not exist. Creating.';
         mkdir($dir);
      }
      $uploaddoc = $dir . '/' . $this->Upload1->FileName;
      if(@move_uploaded_file($this->Upload1->FileTmpName, $uploaddoc))
      {
         $this->UploadStatus->Font->Color = Green;
         $this->UploadStatus->Caption = 'Upload successful.';
      }
      else
      {
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption = 'Upload failure.';
      }
      //parse the file
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