#!/usr/bin/perl
#Setup environment
$name=$ENV{'WWW_name'};
$email=$ENV{'WWW_email'};
$komments=$ENV{'WWW_komments'};
$src_ip=$ENV{'REMOTE_ADDR'};
$src_host=$ENV{'REMOTE_HOST'};
$browser=$ENV{'HTTP_USER_AGENT'};

#$name=$ENV{'WWW_name'};
#$email=$ENV{'WWW_email'};
#$komments=$ENV{'WWW_komments'};
#$src_ip=$ENV{'REMOTE_ADDR'};
#$src_host=$ENV{'REMOTE_HOST'};
#$browser=$ENV{'HTTP_USER_AGENT'};

$currtime=time();
$timestrg=(localtime($currtime));

#Print thank-you form 

print "Content-type: text/html\n\n";
print '<HTML><HEAD>';
print '<TITLE>Thank You for Your Comments</TITLE>';
print '</HEAD><BODY BACKGROUND="/graphics/paper4.jpeg">';
print '<H1>Thanks for your comments!</H1>';
print "<P>Thank you $name for your comments.  You said:<BR>";
print "Comments:\n $komments<BR>";
print '<HR><CENTER><A HREF="http://www.w3oi.org/main.htm">Back</A> to W3OI</CENTER>';
print "</BODY></HTML>\n\n";

#Send me mail

open (OUTFILE, "|mail Paul.Ryan\@USA.NET -s \"LVARC Comments\"");
print OUTFILE ("Feedback on $timestrg from $src_host at $src_ip\n");
print OUTFILE ("for $name at $email using $browser.\n");
print OUTFILE ("Comments: $komments \n");
close OUTFILE ;



