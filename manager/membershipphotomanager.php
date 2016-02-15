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
class MembershipPhotoController extends Page
{
   public $RemoveMember = null;
   public $UpdateMember = null;
   public $AddMember = null;
   public $Label1 = null;
   public $Label2 = null;
   public $Username = null;
   public $LogIn = null;
   public $Label3 = null;
   public $Password = null;
   public $LoginStatus = null;
   public $LoginPanel = null;
   public $ButtonPanel = null;
   function LogInClick($sender, $params)
   {
      //reset the button panel to non visible
      $this->ButtonPanel->Visible = false;
      //check login info
      //only two accounts are allowed admin and treasury for modification
      //of records
      //check that the user name is 'w3oiboardmem' or
      //check that the user name is 'w3oiadmin'
      if(($this->Username->Text != 'w3oiboardmem') &&
      ($this->Username->Text != 'w3oiadmin'))
      {
         $this->LoginStatus->Font->Color = Red;
         $this->LoginStatus->Caption = 'Incorrect username or password';
         return;
      }
      //check the user log in against the database
      $dbconnection = dbConnectOtherUsers($this->Username->Text,
      $this->Password->Text);
      //check for database connection success
      if($dbconnection)
      {
         $this->LoginStatus->Font->Color = DarkGreen;
         $this->LoginStatus->Caption = 'Success';
         $this->ButtonPanel->Visible = true;
      }
      else
      {
         $this->LoginStatus->Font->Color = Red;
         $this->LoginStatus->Caption = 'Incorrect username or password';
      }
   }
}

global $application;

global $MembershipPhotoController;

//Creates the form
$MembershipPhotoController = new MembershipPhotoController($application);

//Read from resource file
$MembershipPhotoController->loadResource(__FILE__);

//Shows the form
$MembershipPhotoController->show();

?>