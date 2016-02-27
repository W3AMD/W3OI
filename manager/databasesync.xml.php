<?php
<object class="DatabaseSync" name="DatabaseSync" baseclass="Page">
  <property name="Animations">a:0:{}</property>
  <property name="Background"></property>
  <property name="Caption">Database Sync</property>
  <property name="Height">370</property>
  <property name="HiddenFields">a:0:{}</property>
  <property name="Name">DatabaseSync</property>
  <property name="Width">597</property>
  <object class="Upload" name="Upload1" >
    <property name="Animations">a:0:{}</property>
    <property name="Height">21</property>
    <property name="Left">16</property>
    <property name="Name">Upload1</property>
    <property name="Top">32</property>
    <property name="Width">260</property>
  </object>
  <object class="Label" name="Label1" >
    <property name="Animations">a:0:{}</property>
    <property name="Caption"><![CDATA[Select W3OI Original Database Dump File To Import &amp; Syncronize]]></property>
    <property name="Height">13</property>
    <property name="Left">16</property>
    <property name="Name">Label1</property>
    <property name="Top">8</property>
    <property name="Width">403</property>
  </object>
  <object class="Button" name="UploadSync" >
    <property name="Animations">a:0:{}</property>
    <property name="Caption"><![CDATA[Upload &amp; Sync]]></property>
    <property name="Height">25</property>
    <property name="Left">16</property>
    <property name="Name">UploadSync</property>
    <property name="Top">64</property>
    <property name="Width">91</property>
    <property name="OnClick">UploadSyncClick</property>
  </object>
  <object class="Label" name="UploadStatus" >
    <property name="Animations">a:0:{}</property>
    <property name="Height">13</property>
    <property name="Left">16</property>
    <property name="Name">UploadStatus</property>
    <property name="Top">104</property>
    <property name="Width">323</property>
  </object>
  <object class="ProgressBar" name="SyncProgress" >
    <property name="Animations">a:0:{}</property>
    <property name="Height">17</property>
    <property name="Left">16</property>
    <property name="Min">0</property>
    <property name="Name">SyncProgress</property>
    <property name="Orientation">pbHorizontal</property>
    <property name="ParentShowHint"></property>
    <property name="Position">0</property>
    <property name="Top">128</property>
    <property name="Width">200</property>
  </object>
  <object class="Label" name="CallsignCheck" >
    <property name="Animations">a:0:{}</property>
    <property name="Height">13</property>
    <property name="Left">248</property>
    <property name="Name">CallsignCheck</property>
    <property name="Top">128</property>
    <property name="Width">75</property>
  </object>
</object>
?>
