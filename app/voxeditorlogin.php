<?php
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");

//Class definition
class VOXEditorLogin extends Page
{
    public $Label1 = null;
    public $Label2 = null;
    public $Username = null;
    public $Label3 = null;
    public $Password = null;
    public $LogIn = null;
}

global $application;

global $VOXEditorLogin;

//Creates the form
$VOXEditorLogin=new VOXEditorLogin($application);

//Read from resource file
$VOXEditorLogin->loadResource(__FILE__);

//Shows the form
$VOXEditorLogin->show();

?>