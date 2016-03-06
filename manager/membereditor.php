<?php
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("db.inc.php");
use_unit("dbctrls.inc.php");

//Class definition
class membereditor extends Page
{
   public $Label34 = null;
   public $lnamesearch = null;
   public $Label33 = null;
   public $Label27 = null;
   public $callsearch = null;
   public $Search = null;
   public $Label32 = null;
   public $boardsource = null;
   public $Label30 = null;
   public $Label31 = null;
   public $DBRepeater2 = null;
   public $boardtable = null;
   public $Label28 = null;
   public $NextButton = null;
   public $Label26 = null;
   public $Label25 = null;
   public $paidtable = null;
   public $paidsource = null;
   public $Label24 = null;
   public $DBRepeater1 = null;
   public $Update = null;
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
   public $Label29 = null;
   function UpdateClick($sender, $params)
   {
      //update the record
      $this->tbmembers1->post();
   }
   function tbmembers1AfterOpen($sender, $params)
   {
      //create the query for the paid records
      $idnum = intval($this->tbmembers1->member_id);
      $selectmemberid = "member_id=$idnum";
      $this->Label28->Caption = 'paid: ' . $selectmemberid;
      $this->Label29->Caption = 'board: ' . $selectmemberid;
      $this->paidtable->Active = false;
      $this->paidtable->Filter = $selectmemberid;
      $this->paidtable->Active = true;
      //create the query for board records
      $this->boardtable->Active = false;
      $this->boardtable->Filter = $selectmemberid;
      $this->boardtable->Active = true;
   }
   function NextButtonClick($sender, $params)
   {
      /*
      $idnum = intval($this->tbmembers1->member_id) + 1;
      $selectmemberid = "member_id=$idnum";
      $this->tbmembers1->Active = false;
      $this->tbmembers1->Filter = $selectmemberid;
      $this->tbmembers1->Active = true;
      */
      $this->tbmembers1->NextRecord();
   }
   function SearchClick($sender, $params)
   {
      // do a search
      if($this->callsearch->Text != '')
      {
         $fcccallsign = $this->callsearch->Text;
         $searchstring = "fcccall LIKE '%$fcccallsign%'";
         $this->tbmembers1->Active = false;
         $this->tbmembers1->Filter = $searchstring;
         $this->tbmembers1->Active = true;
      } elseif ($this->lnamesearch->Text != '') {
         $lastname = $this->lnamesearch->Text;
         $searchstring = "lname LIKE '%$lastname%'";
         $this->tbmembers1->Active = false;
         $this->tbmembers1->Filter = $searchstring;
         $this->tbmembers1->Active = true;
      }
   }
}

global $application;

global $membereditor;

//Creates the form
$membereditor = new membereditor($application);

//Read from resource file
$membereditor->loadResource(__FILE__);

//Shows the form
$membereditor->show();

?>