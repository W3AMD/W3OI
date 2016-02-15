<?php
//copyright 2016 LVARC
//Author: W3AMD John Borchers
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
include('../includes/sqlfunctions.inc.php');
include('../includes/connection.inc.php');
//Class definition
class VOXEditorLogin extends Page
{
   public $Memo1 = null;
   public $UploadStatus = null;
   public $UploadVOX = null;
   public $Label5 = null;
   public $Label4 = null;
   public $LoginStatus = null;
   public $Panel1 = null;
   public $Label1 = null;
   public $Label2 = null;
   public $Username = null;
   public $Label3 = null;
   public $Password = null;
   public $LogIn = null;
   public $AddPanel = null;
   public $AddButton = null;
   public $UploadPanel = null;
   public $Upload1 = null;
   function LogInClick($sender, $params)
   {
      //check that the user name is 'w3oivoxeditor'
      if($this->Username->Text != 'w3oivoxeditor') {
         $this->AddPanel->Visible = false;
         $this->UploadPanel->Visible = false;
         $this->LoginStatus->Font->Color = Red;
         $this->LoginStatus->Caption = 'Incorrect username or password';
         return;
      }
      //check the user log in against the database
      $dbconnection = dbConnectOtherUsers($this->Username->Text,
      $this->Password->Text);
      //check for connection success
      if($dbconnection)
      {
         $this->LoginStatus->Font->Color = Green;
         $this->LoginStatus->Caption = 'Success';
         //enable add panel
         $this->AddPanel->Visible = true;
      }
      else
      {
         $this->AddPanel->Visible = false;
         $this->UploadPanel->Visible = false;
         $this->LoginStatus->Font->Color = Red;
         $this->LoginStatus->Caption = 'Incorrect username or password';
      }
   }
   function AddButtonClick($sender, $params)
   {
      //enable add panel
      $this->UploadPanel->Visible = true;
   }
   function UploadVOXClick($sender, $params)
   {
      //upload the file
      $this->Memo1->Clear();
      $this->Memo1->AddLine('Server says version: ' . phpversion());
      $this->Memo1->AddLine('*FileTmpName: ' . $this->Upload1->FileTmpName);
      $this->Memo1->AddLine('FileName: ' . $this->Upload1->FileTmpName);
      $this->Memo1->AddLine('FileSize: ' . $this->Upload1->FileSize);
      $this->Memo1->AddLine('FileType: ' . $this->Upload1->FileType);
      $this->Memo1->AddLine('FileSubType : ' . $this->Upload1->FileSubType);
      $this->Memo1->AddLine('File Ext: ' . $this->Upload1->FileExt);
      $this->Memo1->AddLine('File userfile: ' . $_FILES['userfile']['tmp_name']);
      $this->Memo1->AddLine('Server says File userfile: ' . ($_FILES['userfile']));
      $this->Memo1->AddLine('Server says File tmp_name: ' . ($_FILES['tmp_name']));
      $this->Memo1->AddLine('Files to upload:' . $_FILES["fileToUpload"]["tmp_name"]);
      //check that the file extension is a pdf file
      if($this->Upload1->FileExt != 'pdf')
      {
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption = 'File type is not a PDF document. Please try again.';
         return;
      }
      //check the file format for MMMYYVOX.pdf
      $day = '01';
      $month = substr($this->Upload1->FileName, 0, 3);
      $year = substr($this->Upload1->FileName, 3, 2);
      $testtimemonth = strtotime($day . $month . '00');
      $testtimeyear = strtotime($day . '12' . $year);
      //test the month and the year to see if it's an integer
      if( !$testtimemonth)
      {
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption
          = 'The month is not a 3 character month. The file is not in the '
          . 'correct format of MMMYYVOX.PDF. Please try again.';
         return;
      }
      //test the year to see if it's an integer
      if( !$testtimeyear)
      {
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption
          = 'The year is not a 2 character year. The file is not in the '
          . 'correct format of MMMYYVOX.PDF. Please try again.';
         return;
      }
      $time = strtotime($day . $month . $year);
      if( ! $time)
      {
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption
          = 'File is not in the correct format of MMMYYVOX.PDF. Please try again.';
         return;
      }
      //check that this year directory exists
      $thisyear = idate('Y', $time);
      $dir = '../newsletter/' . $thisyear;
      if( ! is_dir($dir))
      {
         $this->Memo1->AddLine('Directory ' . $dir . ' does not exist. Creating.');
         mkdir($dir);
      }
      else
      {
         $this->Memo1->AddLine('Directory ' . $dir . ' exists.');
      }
      $uploaddoc = $dir . '/' . $this->Upload1->FileName;
      $this->Memo1->AddLine('*Upload location: ' . $uploaddoc);
      if(@move_uploaded_file($this->Upload1->FileTmpName, $uploaddoc))
      {
         $this->UploadStatus->Font->Color = Green;
         $this->UploadStatus->Caption = 'Upload successful. Thanks for the VOX.';
      }
      else
      {
         $this->UploadStatus->Font->Color = Red;
         $this->UploadStatus->Caption = 'Upload failure. Please try again.';
      }
   }
}

global $application;

global $VOXEditorLogin;

//Creates the form
$VOXEditorLogin = new VOXEditorLogin($application);

//Read from resource file
$VOXEditorLogin->loadResource(__FILE__);

//Shows the form
$VOXEditorLogin->show();

?>