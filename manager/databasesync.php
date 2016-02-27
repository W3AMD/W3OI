<?php
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");

//Class definition
class DatabaseSync extends Page
{
    public $Upload1 = null;
    public $Label1 = null;
    public $UploadSync = null;
    function UploadSyncClick($sender, $params)
    {
     //upload the file
     //parse the file
    }
}

global $application;

global $DatabaseSync;

//Creates the form
$DatabaseSync=new DatabaseSync($application);

//Read from resource file
$DatabaseSync->loadResource(__FILE__);

//Shows the form
$DatabaseSync->show();

?>