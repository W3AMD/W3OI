<?php
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("db.inc.php");

//Class definition
class Page3 extends Page
{
    public $Label1 = null;
    public $Label2 = null;
    public $dbw3oiworkinprog1 = null;
    public $tbmembers1 = null;
    public $dsmembers1 = null;
    public $Edit1 = null;
    public $Label3 = null;
    public $Edit2 = null;
    public $Label4 = null;
    public $Edit3 = null;
    public $Label5 = null;
    public $Edit4 = null;
    public $Label6 = null;
    public $Edit5 = null;
    public $Label7 = null;
    public $Edit6 = null;
    public $Label8 = null;
    public $Edit7 = null;
    public $Label9 = null;
    public $Edit8 = null;
    public $Label10 = null;
    public $Edit9 = null;
    public $Label11 = null;
    public $Edit10 = null;
    public $Label12 = null;
    public $Edit11 = null;
    public $Label13 = null;
    public $Edit12 = null;
    public $Label14 = null;
    public $Edit13 = null;
    public $Label15 = null;
    public $Edit14 = null;
    public $Label16 = null;
    public $Edit15 = null;
    public $Label17 = null;
    public $Edit16 = null;
    public $Label18 = null;
    public $Edit17 = null;
    public $Label19 = null;
    public $Edit18 = null;
    public $Label20 = null;
    public $member_id1 = null;
    public $CheckBox1 = null;
    public $CheckBox2 = null;
    public $CheckBox3 = null;
    public $Label21 = null;
    public $Label22 = null;
    public $Label23 = null;
    public $Memo1 = null;
    public $CheckBox4 = null;
    function UpdateClick($sender, $params)
    {
     //update the record
     $this->dbw3oiworkinprog1->update('members');
    }
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