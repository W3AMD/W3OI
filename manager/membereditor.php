<?php
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("db.inc.php");
use_unit("dbctrls.inc.php");
use_unit("styles.inc.php");

//Class definition
class Page3 extends Page
{
    public $Label2 = null;
    public $Memo1 = null;
    public $Label1 = null;
    public $fcccall1 = null;
    public $members1 = null;
    public $dsmembers1 = null;
    public $tbmembers1 = null;
    public $dbw3oiworkinprog1 = null;
}

global $application;

global $Page3;

//Creates the form
$Page3=new Page3($application);

//Read from resource file
$Page3->loadResource(__FILE__);

//Shows the form
$Page3->show();

?>