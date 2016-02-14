<?php
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
   public $UploadStatus2 = null;
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
      //$this->Upload1->FileTmpName='test.pdf';
   }
   function UploadVOXClick($sender, $params)
   {
      //check the file format for MMMYYVOX.pdf
      //check that this year directory exists
      //check that the file doesn't already exist
      //upload the file
      $this->UploadStatus->Caption = 'VOXClick ' . $this->Upload1->FileName;
      $this->Memo1->AddLine('FileTmpName: ' . $this->Upload1->FileTmpName);
      $this->Memo1->AddLine('FileName: ' . $this->Upload1->FileName);
      $this->Memo1->AddLine('FileSize: ' . $this->Upload1->FileSize);
      $this->Memo1->AddLine('FileType: ' . $this->Upload1->FileType);
      $this->Memo1->AddLine('FileSubType : ' . $this->Upload1->FileSubType);
      $this->Memo1->AddLine('GraphicWidth: ' . $this->Upload1->GraphicWidth);
      $this->Memo1->AddLine('GraphicHeihgt: ' . $this->Upload1->GraphicHeight);
      if($this->Upload1->isGIF())
         $tmp = ' is gif';
      if($this->Upload1->isJPEG())
         $tmp = ' is jpeg';
      if($this->Upload1->isPNG())
         $tmp = ' is png';
      $this->Memo1->AddLine('File Ext: ' . $this->Upload1->FileExt . $tmp);
      if(move_uploaded_file($this->Upload1->FileTmpName, $this->Upload1->FileName))
      {
         echo "File is valid, and was successfully uploaded.\n";
      }
      else
      {
         echo "Possible file upload attack!\n";
      }

   }
   function Upload1Uploaded($sender, $params)
   {
      $this->UploadStatus2->Caption = $this->Upload1->FileTmpName;
   }
   function Upload1Submit($sender, $params)
   {
      $this->Memo1->AddLine('Submit');
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