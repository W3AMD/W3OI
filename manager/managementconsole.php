<?php
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");

//Class definition
class ManagementConsole extends Page
{
   public $Label1 = null;
   public $Home = null;
   public $Announcements = null;
   public $Members = null;
   public $VoxEditor = null;
   public $VETest = null;
    public $MembersPhotos = null;
   function HomeClick($sender, $params)
   {
      ?>
      <script>
      window.location = '../index.html';
      </script>
      <?php
   }
    function MembersClick($sender, $params)
    {
      ?>
      <script>
      window.location = 'membershipmanager.php';
      </script>
      <?php
    }
    function VoxEditorClick($sender, $params)
    {
      ?>
      <script>
      window.location = 'voxeditormanager.php';
      </script>
      <?php
    }
    function AnnouncementsClick($sender, $params)
    {
      ?>
      <script>
      window.location = 'announcementmanager.php';
      </script>
      <?php
    }
    function VETestClick($sender, $params)
    {
      ?>
      <script>
      window.location = 'vetestschedulemanager.php';
      </script>
      <?php
    }
    function MembersPhotosClick($sender, $params)
    {
      ?>
      <script>
      window.location = 'membershipphotomanager.php';
      </script>
      <?php
    }
}

global $application;

global $ManagementConsole;

//Creates the form
$ManagementConsole = new ManagementConsole($application);

//Read from resource file
$ManagementConsole->loadResource(__FILE__);

//Shows the form
$ManagementConsole->show();

?>