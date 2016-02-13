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
   public $Label1 = null;
   public $Label2 = null;
   public $Username = null;
   public $Label3 = null;
   public $Password = null;
   public $LogIn = null;
    public $LoginStatus = null;
   function LogInClick($sender, $params)
   {
      //check the user log in against the database
      $this->LoginStatus->Font->Color=Blue;
      $this->LoginStatus->Caption='Logging In';
      $dbconnection = dbConnectOtherUsers($this->Username->Text,
      $this->Password->Text);
      if($dbconnection)
      {
         $this->LoginStatus->Font->Color=Green;
         $this->LoginStatus->Caption='Success';
      }
      else
      {
         $this->LoginStatus->Font->Color=Red;
         $this->LoginStatus->Caption='Incorrect username or password';
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