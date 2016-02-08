<?php ob_start() ?>
<?php 
if ($_GET['randomId'] != "tJSEtaDUq7B_bQDcwzvOa3h_k3dmiaT0uuYwZnAgo7dSk1NsZfsJ3R_nF1xxL6pKF66wqvEBcLPhf0MKK9Ww5WX6miijvO0xlKtfimoDcxQSJuLbJLv6APsSigEU1K8jQP4ALAAf6ENjJsOAUfB3mfuzxcjpYJL0CV4dx5cEMNdYQqN92s194iG114F6vF7C2xixJq1OOyqc4nJxlAS8ubvPpon_swuUi_aRrZmb5zsQeRA33k3sRU0Rx667acfv") {
	echo "Access Denied";
	exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Editing LouN3OL.htm</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">body {background-color:threedface; border: 0px 0px; padding: 0px 0px; margin: 0px 0px}</style>
</head>
<body>
<div align="center">
<script language="javascript">
<!--//
// this function updates the code in the textarea and then closes this window
function do_save() {
	var code =  htmlCode.getCode();
	document.open();
	document.write("<html><form METHOD=POST name=mform action='http://www.w3oi.org:2082/frontend/x/files/savehtmlfile.html'><input type=hidden name=dir value='/home/w3oiorg/www/MbrPics'><input type=hidden name=file value='LouN3OL.htm'>Saving ....<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><textarea name=page rows=1 cols=1></textarea></form></html>");
	document.close();
	document.mform.page.value = code;
	document.mform.submit();
}
function do_abort() {
	var code =  htmlCode.getCode();
	document.open();
	document.write("<html><form METHOD=POST name=mform action='http://www.w3oi.org:2082/frontend/x/files/aborthtmlfile.html'><input type=hidden name=dir value='/home/w3oiorg/www/MbrPics'><input type=hidden name=file value='LouN3OL.htm'>Aborting Edit ....</form></html>");
	document.close();
	document.mform.submit();
}
//-->
</script>
<?php
// make sure these includes point correctly:
include_once ('/home/w3oiorg/public_html/WysiwygPro/editor_files/config.php');
include_once ('/home/w3oiorg/public_html/WysiwygPro/editor_files/editor_class.php');

// create a new instance of the wysiwygPro class:
$editor = new wysiwygPro();

// add a custom save button:
$editor->addbutton('Save', 'before:print', 'do_save();', WP_WEB_DIRECTORY.'images/save.gif', 22, 22, 'undo');

// add a custom cancel button:
$editor->addbutton('Cancel', 'before:print', 'do_abort();', WP_WEB_DIRECTORY.'images/cancel.gif', 22, 22, 'undo');

$body = '<HTML>
<TITLE>
Personal Data for Louis Poli, N3OL
    </TITLE>
  </HEAD>
<BODY BGCOLOR=#66CCff>
<TABLE BORDER=1 WIDTH="100%"  BGCOLOR=\"#1E90FF\">
<col=bottom span=3 FRAME=BOX>
<TR><TH COLSPAN=2 ALIGN=center>Louis Poli, N3OL</TH></TR>
<TR valign=center>
<TD width="50%" ALIGN=center >
<IMG SRC="LouN3OL.jpg" BORDER=0 ALT="Louis Poli, N3OL">  
<TD width="50%" ALIGN=left >
Respected member and program presenter who always
dazzles his audiance.  Ask Lou about TUBES... 
</TR>
<TR><td colspan=2 align=center><form><input type="button" value="Back to previous page" onClick="history.back()"></form></td></TR>
<TR>
<Th colspan=2 align=center>
<A HREF="../main.htm">Home</A>
</TR>
</TABLE>
</BODY>
</HTML>

';

$editor->set_code($body);

// add a spacer:
$editor->addspacer('', 'after:cancel');

// print the editor to the browser:
$editor->print_editor('100%',450);

?>
</div>
</body>
</html>
<?php ob_end_flush() ?>
