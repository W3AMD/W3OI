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
    public $UploadButton = null;
   function LogInClick($sender, $params)
   {
      //check the user log in against the database
      $dbconnection = dbConnectOtherUsers($this->Username->Text,
      $this->Password->Text);
      //check for connection success
      if($dbconnection)
      {
         $this->LoginStatus->Font->Color=Green;
         $this->LoginStatus->Caption='Success';
         //enable add panel
         $this->AddPanel->Visible=true;
      }
      else
      {
         $this->AddPanel->Visible=false;
         $this->UploadPanel->Visible=false;
         $this->LoginStatus->Font->Color=Red;
         $this->LoginStatus->Caption='Incorrect username or password';
      }
   }
    function AddButtonClick($sender, $params)
    {
         //enable add panel
         $this->UploadPanel->Visible=true;
    }
    function UploadButtonClick($sender, $params)
    {
     //check the file format for MMMYYVOX.pdf
     //check that this year directory exists
     //check that the file doesn't already exist
     //upload the file
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