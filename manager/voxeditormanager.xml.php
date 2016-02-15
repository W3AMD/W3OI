<?php
<object class="VOXEditorLogin" name="VOXEditorLogin" baseclass="Page">
  <property name="Alignment">agCenter</property>
  <property name="Animations">a:0:{}</property>
  <property name="Background"></property>
  <property name="Caption">VOX Editor Login</property>
  <property name="Color">#99CC66</property>
  <property name="Height">619</property>
  <property name="HiddenFields">a:0:{}</property>
  <property name="Name">VOXEditorLogin</property>
  <property name="UseAjax">1</property>
  <property name="Width">405</property>
  <object class="Panel" name="Panel1" >
    <property name="Animations">a:0:{}</property>
    <property name="Caption">Panel1</property>
    <property name="Color">#99CC66</property>
    <property name="Height">171</property>
    <property name="Left">5</property>
    <property name="Name">Panel1</property>
    <property name="ParentColor">0</property>
    <property name="Width">395</property>
    <object class="Label" name="Label1" >
      <property name="Alignment">agCenter</property>
      <property name="Animations">a:0:{}</property>
      <property name="Caption">VOX Editor Login</property>
      <property name="Color">#99CC66</property>
      <property name="Font">
      <property name="Color">DarkGreen</property>
      <property name="Size">20px</property>
      </property>
      <property name="Height">27</property>
      <property name="Left">12</property>
      <property name="Name">Label1</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">16</property>
      <property name="Width">372</property>
    </object>
    <object class="Label" name="Label2" >
      <property name="Animations">a:0:{}</property>
      <property name="Caption">Username:</property>
      <property name="Color">#99CC66</property>
      <property name="Font">
      <property name="Size">16px</property>
      </property>
      <property name="Height">25</property>
      <property name="Left">12</property>
      <property name="Name">Label2</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">64</property>
      <property name="Width">75</property>
    </object>
    <object class="Edit" name="Username" >
      <property name="Animations">a:0:{}</property>
      <property name="Font">
      <property name="Size">16px</property>
      </property>
      <property name="Height">27</property>
      <property name="Left">100</property>
      <property name="Name">Username</property>
      <property name="ParentFont">0</property>
      <property name="Top">64</property>
      <property name="Width">121</property>
    </object>
    <object class="Label" name="Label3" >
      <property name="Animations">a:0:{}</property>
      <property name="Caption">Password:</property>
      <property name="Color">#99CC66</property>
      <property name="Font">
      <property name="Size">16px</property>
      </property>
      <property name="Height">20</property>
      <property name="Left">12</property>
      <property name="Name">Label3</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">110</property>
      <property name="Width">75</property>
    </object>
    <object class="Edit" name="Password" >
      <property name="Animations">a:0:{}</property>
      <property name="Font">
      <property name="Size">16px</property>
      </property>
      <property name="Height">27</property>
      <property name="InputType">cePassword</property>
      <property name="Left">100</property>
      <property name="Name">Password</property>
      <property name="ParentFont">0</property>
      <property name="Top">106</property>
      <property name="Width">121</property>
    </object>
    <object class="Button" name="LogIn" >
      <property name="Animations">a:0:{}</property>
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Log In</property>
      <property name="Color">#C0C0C0</property>
      <property name="Height">25</property>
      <property name="Left">250</property>
      <property name="Name">LogIn</property>
      <property name="ParentColor">0</property>
      <property name="Top">73</property>
      <property name="Width">75</property>
      <property name="OnClick">LogInClick</property>
    </object>
    <object class="Label" name="LoginStatus" >
      <property name="Alignment">agCenter</property>
      <property name="Animations">a:0:{}</property>
      <property name="Color">#99CC66</property>
      <property name="Font">
      <property name="Color">Crimson</property>
      </property>
      <property name="Height">27</property>
      <property name="Left">16</property>
      <property name="Name">LoginStatus</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">138</property>
      <property name="Width">363</property>
    </object>
  </object>
  <object class="Panel" name="AddPanel" >
    <property name="Animations">a:0:{}</property>
    <property name="Caption">AddPanel</property>
    <property name="Color">#99CC66</property>
    <property name="Height">59</property>
    <property name="Left">5</property>
    <property name="Name">AddPanel</property>
    <property name="ParentColor">0</property>
    <property name="Top">176</property>
    <property name="Visible">0</property>
    <property name="Width">395</property>
    <object class="Button" name="AddButton" >
      <property name="Animations">a:0:{}</property>
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Add</property>
      <property name="Color">#C0C0C0</property>
      <property name="Height">25</property>
      <property name="Left">11</property>
      <property name="Name">AddButton</property>
      <property name="ParentColor">0</property>
      <property name="Top">17</property>
      <property name="Width">75</property>
      <property name="OnClick">AddButtonClick</property>
    </object>
  </object>
  <object class="Panel" name="UploadPanel" >
    <property name="Animations">a:0:{}</property>
    <property name="Caption">UploadPanel</property>
    <property name="Color">#99CC66</property>
    <property name="Height">371</property>
    <property name="Name">UploadPanel</property>
    <property name="ParentColor">0</property>
    <property name="Top">240</property>
    <property name="Visible">0</property>
    <property name="Width">400</property>
    <object class="Upload" name="Upload1" >
      <property name="Animations">a:0:{}</property>
      <property name="Color">#C0C0C0</property>
      <property name="Height">21</property>
      <property name="Left">16</property>
      <property name="Name">Upload1</property>
      <property name="ParentColor">0</property>
      <property name="Top">16</property>
      <property name="Width">260</property>
    </object>
    <object class="Label" name="Label4" >
      <property name="Animations">a:0:{}</property>
      <property name="Caption">VOX file format must be MMMYYVOX.pdf</property>
      <property name="Color">#99CC66</property>
      <property name="Height">13</property>
      <property name="Left">112</property>
      <property name="Name">Label4</property>
      <property name="ParentColor">0</property>
      <property name="Top">48</property>
      <property name="Width">277</property>
    </object>
    <object class="Label" name="Label5" >
      <property name="Animations">a:0:{}</property>
      <property name="Caption">Example: Jun13VOX.pdf</property>
      <property name="Color">#99CC66</property>
      <property name="Height">13</property>
      <property name="Left">110</property>
      <property name="Name">Label5</property>
      <property name="ParentColor">0</property>
      <property name="Top">63</property>
      <property name="Width">279</property>
    </object>
    <object class="Button" name="UploadVOX" >
      <property name="Animations">a:0:{}</property>
      <property name="Caption">Upload VOX</property>
      <property name="Color">#C0C0C0</property>
      <property name="Height">25</property>
      <property name="Left">16</property>
      <property name="Name">UploadVOX</property>
      <property name="ParentColor">0</property>
      <property name="Top">48</property>
      <property name="Width">75</property>
      <property name="OnClick">UploadVOXClick</property>
    </object>
    <object class="Label" name="UploadStatus" >
      <property name="Alignment">agCenter</property>
      <property name="Animations">a:0:{}</property>
      <property name="Color">#99CC66</property>
      <property name="Height">35</property>
      <property name="Left">5</property>
      <property name="Name">UploadStatus</property>
      <property name="ParentColor">0</property>
      <property name="Top">88</property>
      <property name="Width">390</property>
    </object>
    <object class="Memo" name="Memo1" >
      <property name="Animations">a:0:{}</property>
      <property name="Color">#99CC66</property>
      <property name="Height">223</property>
      <property name="Left">9</property>
      <property name="Lines">a:0:{}</property>
      <property name="Name">Memo1</property>
      <property name="ParentColor">0</property>
      <property name="Top">129</property>
      <property name="Width">386</property>
    </object>
  </object>
</object>
?>
