<?php
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("comctrls.inc.php");
include('../includes/sqlfunctions.inc.php');
include('../includes/connection.inc.php');

//Class definition
class AnnouncementController extends Page
{
   public $LoginPanel = null;
   public $Label1 = null;
   public $Label2 = null;
   public $Username = null;
   public $LogIn = null;
   public $Label3 = null;
   public $Password = null;
   public $LoginStatus = null;
   function LogInClick($sender, $params)
   {
      //reset the button panel to non visible
      //check login info
      //only two accounts are allowed admin and board members for modification
      //of records
      //check that the user name is 'w3oiboardmem' or
      //check that the user name is 'w3oiadmin'
      if(($this->Username->Text != 'lvarcftp_w3oiboardmem') &&
      ($this->Username->Text != 'lvarcftp_w3oimgr') &&
      ($this->Username->Text != 'lvarcftp_w3oiadm'))
      {
         $this->LoginStatus->Font->Color = 'Red';
         $this->LoginStatus->Caption = 'Incorrect username or password';
         return;
      }
      //check the user log in against the database
      $dbconnection = dbConnectOtherUsers($this->Username->Text,
      $this->Password->Text);
      //check for database connection success
      if($dbconnection)
      {
         $this->LoginStatus->Font->Color = 'DarkGreen';
         $this->LoginStatus->Caption = 'Success';
         //redirect
         ?>
         <script>
         window.location = 'announcementeditor.php';
         </script>
         <?php

      }
      else
      {
         $this->LoginStatus->Font->Color = 'Red';
         $this->LoginStatus->Caption = 'Incorrect username or password';
      }

   }
}

global $application;

global $AnnouncementController;

//Creates the form
$AnnouncementController = new AnnouncementController($application);

//Read from resource file
$AnnouncementController->loadResource(__FILE__);

//Shows the form
$AnnouncementController->show();

?>