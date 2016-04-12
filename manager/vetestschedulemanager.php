<?php
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
include('../includes/sqlfunctions.inc.php');
include('../includes/connection.inc.php');

//Class definition
class VETestController extends Page
{
    public $LoginPanel = null;
    public $Label1 = null;
    public $Label2 = null;
    public $Username = null;
    public $LogIn = null;
    public $Label3 = null;
    public $Password = null;
    public $LoginStatus = null;
    public $ButtonPanel = null;
    public $AddMember = null;
    public $UpdateMember = null;
    public $RemoveMember = null;
    function LogInClick($sender, $params)
    {
       //reset the button panel to non visible
      $this->ButtonPanel->Visible = false;
      //check login info
      //only two accounts are allowed admin and VE members for modification
      //of records
      //check that the user name is 'w3oive' or
      //check that the user name is 'w3oiadmin'
      if(($this->Username->Text != 'lvarcftp_w3oive') &&
      ($this->Username->Text != 'lvarcftp_w3oimgr') &&
      ($this->Username->Text != 'lvarcftp_w3oiadm'))
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

global $VETestController;

//Creates the form
$VETestController=new VETestController($application);

//Read from resource file
$VETestController->loadResource(__FILE__);

//Shows the form
$VETestController->show();

?>