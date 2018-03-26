<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    /*if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    */
	if($UserName=='w3oiofficer') {
	  $isValid = true; 
    }
	/*
	if (($strUsers == "") && true) { 
      $isValid = true; 
    } */
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../membersarea/login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<HTML>
<HEAD>
<TITLE>W3OI Management Console</TITLE>
<META http-equiv="pragma" content="no-cache">
<META http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<LINK rel="shortcut icon" href="../favicon.ico"></LINK>
<!-- LINK href="../css/main.css" rel="stylesheet" type="text/css"></LINK -->
<link rel='stylesheet' type='text/css' href='./jquery/pepper-grinder/jquery-ui-1.8.17.custom.css' />
<script type='text/javascript' src='./jquery/jquery-1.5.2.min.js'></script>
<script type='text/javascript' src='./jquery/jquery-ui-1.8.17.custom.min.js'></script>
<style type='text/css'>
.plaintext{
	border: 2px solid black;
	background-image: url("../images/369.jpg");
	background-repeat: repeat-x repeat-y;
	-moz-box-shadow: 5px 5px 5px #ccc;
	-moz-border-radius: 15px;
	-webkit-box-shadow: 5px 5px 5px #ccc;
	-webkit-border-radius: 15px;
	padding: 0px 25px;
	box-shadow: 5px 5px 5px #ccc;
	border-radius: 15px;
	/*min-width: 600px;*/
}
</style>
</HEAD>
<BODY>

<script type='text/javascript'>
$(document).ready(function () {
	document.title = "W3OI Management Console"; 
});
$(document).ready(function() {
	number = Math.round(Math.random() * 957834582384299);
	$.get('getmessagelist.php?'+number, {}, function(data) {
		$('#announcements').html(data);
	});
});
</script>

<!-- Load TinyMCE -->
<script type="text/javascript" src="./tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : './tinymce/jscripts/tiny_mce/tiny_mce.js',

			// General options
			height : "420",
			theme : "advanced",
			plugins : "autolink,lists,insertdatetime,preview,searchreplace,contextmenu,paste,noneditable,visualchars,nonbreaking",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,forecolor,backcolor,|,hr,|,sub,sup,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,charmap,nonbreaking",
			theme_advanced_buttons3 : "",
			theme_advanced_buttons4 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : false,

			// Example content CSS (should be your site CSS)
			content_css : "./css/main.css",

			// Drop lists for link/image/media/template dialogs
			//template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			//external_image_list_url : "lists/image_list.js",
			//media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			//template_replace_values : {
			//	username : "Some User",
			//	staffid : "991234"
			//}
		});
	});
</script>
<!-- /TinyMCE -->

<script type='text/javascript'>
	$(function() {
		$( "#tabs" ).tabs();
	});

	$(function() {
		$( "input:submit, a, button", ".pagewrapper" ).button();
		$( "a", ".pagewrapper" ).click(function() { return false; });
	});

	$(function() {
		$( "#startdate" ).datepicker();
		$( "#startdate" ).datepicker( "option", "dateFormat", "yy-mm-dd");
		$( "#enddate" ).datepicker();
		$( "#enddate" ).datepicker( "option", "dateFormat", "yy-mm-dd");
	});

	$(function() {
		$('#msgadd').bind('click', function(event) {
			$('#action').val('add');
			$('#recordid').val('');
			$('#message').slideDown('fast', function() {});
			$('#description').focus();
			$('html, body').animate({scrollTop: '0px'}, 300);
		});
		$('#msgsave').bind('click', function(event) {
			if (formValid())
			{
				url = "addmessage.php";
				$.post(	url,
							{
								"description"  : $('#description').val(),
								"startdate"    : $.datepicker.formatDate( 'yy-mm-dd', $('#startdate').datepicker('getDate') ),
								"enddate"      : $.datepicker.formatDate( 'yy-mm-dd', $('#enddate').datepicker('getDate') ),
								"displayorder" : $('#displayorder').val(),
								"id"           : $('#recordid').val(),
								"action"       : $('#action').val()
							},
							function(res){
								if ( res == '1')
								{
									successmessage = 'Record ';
									if ($('#action').val() == 'edit')
									{
										successmessage = successmessage + 'updated';
									} else {
										successmessage = successmessage + 'added';
									}
									successmessage = successmessage + ' successfully';
									alert(successmessage);
									clearform();
									number = Math.round(Math.random() * 957834582384299);
									$.get('getmessagelist.php?'+number, {}, function(data) {
										$('#announcements').html(data);
									});
								}
								else
								{
									alert(res);
								}
							});
				$('#message').slideUp('fast', function() {});
			}
		});
		$('#msgcancel').bind('click', function(event) {
			clearform();
			$('#message').slideUp('fast', function() {});
		});
		$('#msgdelete').bind('click', function(event) {
			url = "deletemessage.php";
			$.post(	url, {"id" : $('#msgid').val()}, function(res){
					if ( res == '1')
					{
						successmessage = 'Record deleted successfully';
						alert(successmessage);
						number = Math.round(Math.random() * 957834582384299);
						$.get('getmessagelist.php?'+number, {}, function(data) {
							$('#announcements').html(data);
						});
					}
					else
					{
						alert(res);
					}
				});
			$('#announcedelete').slideUp('fast', function() {});
		});
		$('#msgdeletecancel').bind('click', function(event) {
			$('#announcedelete').slideUp('fast', function() {});
		});
	});

	function msgedit(id) {
		// JSONP call using jQuery
		number = Math.round(Math.random() * 957834582384299);
		url = "getmessage.php";
		$.getJSON(url, {'id': id, 'number': number}, function(msg) {
			$('#description').val(msg.description);
			$('#startdate').val(msg.startdate);
			$('#enddate').val(msg.enddate);
			$('#displayorder').val(msg.displayorder);
			$('#action').val('edit');
			$('#recordid').val(id);
			$('#message').slideDown('fast', function() {});
			$('#description').focus();
			$('html, body').animate({scrollTop: '0px'}, 300);
		})
	}

	function clearform() {
		$('#description').val('');
		$('#startdate').val('');
		$('#enddate').val('');
		$('#displayorder').val('');
		$('#action').val('');
		$('#recordid').val('');
	}

	function msgdelete(id) {
		$('#msgid').val(id);
		$('#announcedelete').slideDown('fast', function() {});
		$('#msgdeletecancel').focus();
		$('html, body').animate({scrollTop: '0px'}, 300);
	}

	function formValid() {
		formvalid = true;

		var dob_regex = /^([0-9]){2}(\/){1}([0-9]){2}(\/)([0-9]){4}$/;   // DD/MM/YYYY
		var date_regex = /^([0-9]){4}(\-){1}([0-9]){2}(\-)([0-9]){2}$/;   // DD/MM/YYYY
		var email_regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;  // email address
		var username_regex = /^[\w.-]+$/;  // allowed characters: any word . -, ( \w ) represents any word character (letters, digits, and the underscore _ ), equivalent to [a-zA-Z0-9_]
		var num_regex = /^\d+$/; // numeric digits only
		var search_regex = "/hello/";
		var password_regex = /^[A-Za-z\d]{6,8}$/;  // any upper/lowercase characters and digits, between 6 to 8 characters in total
		var phone_regex = /^\(\d{3}\) \d{3}-\d{4}$/;  // (xxx) xxx-xxxx
		var question_regex = /\?$/; // ends with a question mark

		if ($('#description').val() == null || $('#description').val().trim() == '')
		{
			alert('Announcement text can not be blank');
			$('#description').focus();
			formvalid = false;
		}

		if ($('#startdate').val() == null || $('#startdate').val().trim() == '')
		{
			alert('You must provide start and end dates for this event');
			$('#startdate').focus();
			formvalid = false;
		} else if (!$('#startdate').val().match(date_regex))
		{
			alert('You must enter a valid date');
			$('#startdate').focus();
			formvalid = false;
		}

		if ($('#enddate').val() == null || $('#enddate').val().trim() == '')
		{
			alert('You must provide start and end dates for this event');
			$('#enddate').focus();
			formvalid = false;
		} else if (!$('#enddate').val().match(date_regex))
		{
			alert('You must enter a valid date');
			$('#enddate').focus();
			formvalid = false;
		}

		// Validate display order field
		if ($('#displayorder').val() == null || $('#displayorder').val().trim() == '')
		{
			alert('Display order can not be blank');
			$('#displayorder').focus();
			formvalid = false;
		} else if (!$('#displayorder').val().match(num_regex))
		{
			alert('Display order must be numeric');
			$('#displayorder').focus();
			formvalid = false;
		}

		return formvalid;
	}

	function validateDelete() {
		recdelete = false;
		alert('Deleting Announcement id: ' + id);
		return recdelete
	}

</script>

<div class="pagewrapper">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Announcements</a></li>
		<!--li><a href="#tabs-2">Proin dolor</a></li-->
		<!--li><a href="#tabs-3">Aenean lacinia</a></li-->
	</ul>
	<div id="tabs-1">
		<div id="message" class="demo" style="display: none; border: 1px solid black; padding: 20px;">
			<form id="announcementedit" name="announcementedit" method="post" action="">
				<table>
					<tr>
						<td width="20%"><label for="descrition">Enter Message:</label></td>
						<td><textarea rows="50" cols="80" name="description" id="description" class="tinymce"></textarea></td>
					</tr>
					<tr>
						<td><label for="startdate">Start Date:</label></td>
						<td><input type="text" id="startdate"/></td>
					</tr>
					<tr>
						<td><label for="enddate">End Date:</label></td>
						<td><input type="text" id="enddate"/></td>
					</tr>
					<tr>
						<td><label for="displayorder">Display Order:</label></td>
						<td><input type="text" id="displayorder"/></td>
					</tr>
					<tr>
					<td colspan="2">
						<input type="hidden" id="action">
						<input type="hidden" id="recordid">
					</td>
					</tr>
					<tr>
						<td colspan="2" style="padding-top:25px;"><a id="msgsave" href="#">Save Announcement</a>&nbsp;<a id="msgcancel" href="#">Cancel</a></td>
					</tr>
				</table>
			</form>
			<br><br>
		</div>
		<div id="announcedelete" class="demo" style="display: none; border: 1px solid black; padding: 20px;">
			<table>
				<tr>
					<td>Are you sure you want to delete this announcement?</td>
				</tr>
				<td>
					<input type="hidden" id="msgid">
				</td>
				<tr>
					<td style="padding-top:25px;"><a name="msgdelete" id="msgdelete" href="#">Delete</a>&nbsp;<a name="msgdeletecancel" id="msgdeletecancel" href="#">Cancel</a></td>
				</tr>
			</table>
			<br><br>
		</div>
		<div style="text-align: right;"><a id="msgadd" href="#">Add Announcement</a></div>
		<table>
			<thead>
				<tr>
					<th width="50%" align="left">Message</th>
					<th width="10%" align="left">Display Order</th>
					<th width="12%" align="left">Start Date</th>
					<th width="12%" align="left">End Date</th>
					<th align="left"></th>
				</tr>
				<tr><th colspan="5" style="border-top: 2px solid black;"></th></tr>
			</thead>
			<tbody id="announcements" name="announcements" style="font: 12px Verdana; margin: 0px; padding: 0px 20px;">
			</tbody>
		</table>
	</div>
	<!--div id="tabs-2">
		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
	</div-->
	<!--div id="tabs-3">
		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
	</div-->
</div>

<!-- div style="display: none;" class="demo-description">
<p>Click tabs to swap between content that is broken into logical sections.</p>
</div --><!-- End demo-description -->

</div>

</BODY>
</HTML>
