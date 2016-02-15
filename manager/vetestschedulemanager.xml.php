<?php
<object class="VETestController" name="VETestController" baseclass="Page">
  <property name="Animations">a:0:{}</property>
  <property name="Background"></property>
  <property name="Caption">VE Test Ctrl</property>
  <property name="Color">#FFFF33</property>
  <property name="Height">495</property>
  <property name="HiddenFields">a:0:{}</property>
  <property name="Name">VETestController</property>
  <property name="Width">597</property>
  <object class="Panel" name="LoginPanel" >
    <property name="Alignment">agCenter</property>
    <property name="Animations">a:0:{}</property>
    <property name="Caption">LoginPanel</property>
    <property name="Color">#FFFF33</property>
    <property name="Height">163</property>
    <property name="Name">LoginPanel</property>
    <property name="ParentColor">0</property>
    <property name="Width">596</property>
    <object class="Label" name="Label1" >
      <property name="Alignment">agCenter</property>
      <property name="Animations">a:0:{}</property>
      <property name="Caption">W3OI VE Schedule Controller</property>
      <property name="Color">#FFFF33</property>
      <property name="Font">
      <property name="Size">20px</property>
      </property>
      <property name="Gradient">
      <property name="EndColor">MediumTurquoise</property>
      </property>
      <property name="Height">27</property>
      <property name="Left">13</property>
      <property name="Name">Label1</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">8</property>
      <property name="Width">571</property>
    </object>
    <object class="Label" name="Label2" >
      <property name="Animations">a:0:{}</property>
      <property name="Caption">Username:</property>
      <property name="Color">#FFFF33</property>
      <property name="Font">
      <property name="Size">14px</property>
      </property>
      <property name="Height">23</property>
      <property name="Left">112</property>
      <property name="Name">Label2</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">48</property>
      <property name="Width">71</property>
    </object>
    <object class="Edit" name="Username" >
      <property name="Animations">a:0:{}</property>
      <property name="Font">
      <property name="Size">14px</property>
      </property>
      <property name="Height">24</property>
      <property name="Left">196</property>
      <property name="Name">Username</property>
      <property name="ParentFont">0</property>
      <property name="Text">w3oive</property>
      <property name="Top">48</property>
      <property name="Width">121</property>
    </object>
    <object class="Button" name="LogIn" >
      <property name="Animations">a:0:{}</property>
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Log In</property>
      <property name="Color">Silver</property>
      <property name="Height">25</property>
      <property name="Left">362</property>
      <property name="Name">LogIn</property>
      <property name="ParentColor">0</property>
      <property name="Top">48</property>
      <property name="Width">75</property>
      <property name="OnClick">LogInClick</property>
    </object>
    <object class="Label" name="Label3" >
      <property name="Animations">a:0:{}</property>
      <property name="Caption">Password:</property>
      <property name="Color">#FFFF33</property>
      <property name="Font">
      <property name="Size">14px</property>
      </property>
      <property name="Height">23</property>
      <property name="Left">111</property>
      <property name="Name">Label3</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">95</property>
      <property name="Width">72</property>
    </object>
    <object class="Edit" name="Password" >
      <property name="Animations">a:0:{}</property>
      <property name="Font">
      <property name="Size">14px</property>
      </property>
      <property name="Height">23</property>
      <property name="InputType">cePassword</property>
      <property name="Left">196</property>
      <property name="Name">Password</property>
      <property name="ParentFont">0</property>
      <property name="Text">c94Vd!c6</property>
      <property name="Top">95</property>
      <property name="Width">121</property>
    </object>
    <object class="Label" name="LoginStatus" >
      <property name="Alignment">agCenter</property>
      <property name="Animations">a:0:{}</property>
      <property name="Color">#FFFF33</property>
      <property name="Font">
      <property name="Color">Crimson</property>
      <property name="Size">14px</property>
      </property>
      <property name="Height">19</property>
      <property name="Left">9</property>
      <property name="Name">LoginStatus</property>
      <property name="ParentColor">0</property>
      <property name="ParentFont">0</property>
      <property name="Top">130</property>
      <property name="Width">577</property>
    </object>
  </object>
  <object class="Panel" name="ButtonPanel" >
    <property name="Animations">a:0:{}</property>
    <property name="Caption">ButtonPanel</property>
    <property name="Color">#FFFF33</property>
    <property name="Height">43</property>
    <property name="Name">ButtonPanel</property>
    <property name="ParentColor">0</property>
    <property name="Top">164</property>
    <property name="Visible">0</property>
    <property name="Width">596</property>
    <object class="Button" name="AddMember" >
      <property name="Animations">a:0:{}</property>
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Add</property>
      <property name="Color">Silver</property>
      <property name="Height">25</property>
      <property name="Left">13</property>
      <property name="Name">AddMember</property>
      <property name="ParentColor">0</property>
      <property name="Top">9</property>
      <property name="Width">75</property>
      <property name="OnClick">LogInClick</property>
    </object>
    <object class="Button" name="UpdateMember" >
      <property name="Animations">a:0:{}</property>
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Update</property>
      <property name="Color">Silver</property>
      <property name="Height">25</property>
      <property name="Left">108</property>
      <property name="Name">UpdateMember</property>
      <property name="ParentColor">0</property>
      <property name="Top">9</property>
      <property name="Width">75</property>
      <property name="OnClick">LogInClick</property>
    </object>
    <object class="Button" name="RemoveMember" >
      <property name="Animations">a:0:{}</property>
      <property name="ButtonType">btNormal</property>
      <property name="Caption">Remove</property>
      <property name="Color">Silver</property>
      <property name="Height">25</property>
      <property name="Left">202</property>
      <property name="Name">RemoveMember</property>
      <property name="ParentColor">0</property>
      <property name="Top">9</property>
      <property name="Width">75</property>
      <property name="OnClick">LogInClick</property>
    </object>
  </object>
</object>
?>
