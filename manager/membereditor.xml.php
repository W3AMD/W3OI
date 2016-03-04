<?php
<object class="Page3" name="Page3" baseclass="Page">
  <property name="Animations">a:0:{}</property>
  <property name="Background"></property>
  <property name="Caption">Page3</property>
  <property name="Height">370</property>
  <property name="HiddenFields">a:0:{}</property>
  <property name="Name">Page3</property>
  <property name="Width">597</property>
  <object class="DBRepeater" name="members1" >
    <property name="Animations">a:0:{}</property>
    <property name="Caption">members1</property>
    <property name="Datasource">dsmembers1</property>
    <property name="Height">51</property>
    <property name="Layout">
    <property name="Type">XY_LAYOUT</property>
    </property>
    <property name="Left">13</property>
    <property name="Name">members1</property>
    <property name="Top">7</property>
    <property name="Width">570</property>
    <object class="Label" name="Label1" >
      <property name="Animations">a:0:{}</property>
      <property name="AutoSize">1</property>
      <property name="Caption">Label1</property>
      <property name="DataField">fname</property>
      <property name="DataSource">dsmembers1</property>
      <property name="Font">
      <property name="Size">14px</property>
      </property>
      <property name="Height">18</property>
      <property name="Left">136</property>
      <property name="Name">Label1</property>
      <property name="ParentFont">0</property>
      <property name="Top">9</property>
      <property name="Width">75</property>
    </object>
    <object class="Label" name="fcccall1" >
      <property name="Animations">a:0:{}</property>
      <property name="AutoSize">1</property>
      <property name="Caption">fcccall1</property>
      <property name="DataField">fcccall</property>
      <property name="Datasource">dsmembers1</property>
      <property name="Font">
      <property name="Size">14px</property>
      </property>
      <property name="Height">19</property>
      <property name="Left">231</property>
      <property name="Name">fcccall1</property>
      <property name="ParentFont">0</property>
      <property name="Top">9</property>
      <property name="Width">75</property>
    </object>
    <object class="Memo" name="Memo1" >
      <property name="Animations">a:0:{}</property>
      <property name="AutoSize">1</property>
      <property name="DataField">addr1</property>
      <property name="DataSource">dsmembers1</property>
      <property name="Font">
      <property name="Size">14px</property>
      </property>
      <property name="Height">27</property>
      <property name="Left">315</property>
      <property name="Lines">a:0:{}</property>
      <property name="Name">Memo1</property>
      <property name="ParentFont">0</property>
      <property name="Top">12</property>
      <property name="Width">185</property>
    </object>
    <object class="Label" name="Label2" >
      <property name="Animations">a:0:{}</property>
      <property name="AutoSize">1</property>
      <property name="Caption">Label2</property>
      <property name="DataField">lname</property>
      <property name="DataSource">dsmembers1</property>
      <property name="Font">
      <property name="Size">14px</property>
      </property>
      <property name="Height">19</property>
      <property name="Left">11</property>
      <property name="Name">Label2</property>
      <property name="ParentFont">0</property>
      <property name="Top">9</property>
      <property name="Width">107</property>
    </object>
  </object>
  <object class="Database" name="dbw3oiworkinprog1" >
        <property name="Left">436</property>
        <property name="Top">95</property>
    <property name="Connected">1</property>
    <property name="ConnectionParams">a:0:{}</property>
    <property name="DatabaseName">w3oiworkinprog</property>
    <property name="DatabaseOptions">a:0:{}</property>
    <property name="DriverName">mysql</property>
    <property name="Host">198.71.227.91</property>
    <property name="Name">dbw3oiworkinprog1</property>
    <property name="Port">3306</property>
    <property name="UserName">server</property>
    <property name="UserPassword"><![CDATA[bV34ne3&amp;]]></property>
  </object>
  <object class="Table" name="tbmembers1" >
        <property name="Left">436</property>
        <property name="Top">145</property>
    <property name="Active">1</property>
    <property name="Database">dbw3oiworkinprog1</property>
    <property name="LimitCount"></property>
    <property name="LimitStart"></property>
    <property name="MasterFields">a:0:{}</property>
    <property name="MasterSource"></property>
    <property name="Name">tbmembers1</property>
    <property name="TableName">members</property>
  </object>
  <object class="Datasource" name="dsmembers1" >
        <property name="Left">436</property>
        <property name="Top">195</property>
    <property name="Dataset">tbmembers1</property>
    <property name="Name">dsmembers1</property>
  </object>
</object>
?>
