#!/usr/bin/perl
$procid=$ENV{'WWW_PROCID'};
$task=$ENV{'WWW_TASK'};
if ($task eq "STOP") {
  unlink ("/tmp/$procid");
  print ("Content-type: text/html\n\n");
  open (HF,"../htdocs/index.html");
  while (<HF>) {
    print $_;
    }
  close (HF);
  }  else  {
print ("Content-type: text/html\n\n");
print ("<HTML><HEAD><TITLE>Fortune Cookie</TITLE>");
if ($task eq "DEL") {
  unlink ("/tmp/$procid");
  }
if ($task ne "SAME") {
  print ("<META HTTP-EQUIV=\"Refresh\" CONTENT=\"15;URL=http://65.200.152.251");
  print ("/cgi-bin/uncgi/fortune-cgi?PROCID=$$&TASK=DEL\">");
  system("/usr/games/fortune >/tmp/$$");
  $procid=$$;
  }
print ("</HEAD>\n<BODY BGCOLOR=\"WHITE\"><H3><BR>Your Daily Fortune.......</H3><HR>");
print ("<TABLE BORDER=4 WIDTH=\"100%\" COL=1>");
print ("<TR ><TD VALIGN=\"center\" BGCOLOR=\"Black\"><FONT SIZE=\"+1\" COLOR=\"WHITE\"><PRE>");
open (CF,"/tmp/$procid");
while (<CF>) {
  print $_;
  }
close (CF);  
print '</FONT></PRE></TR></TABLE><HR>';
print '<TABLE ALIGN="center" WIDTH="100%"><TR>';
print "<TD ALIGN=\"center\"><A HREF=\"/cgi-bin/uncgi/fortune-cgi?PROCID=$procid&TASK=DEL\">Another Cookie</A>";
print "<TD ALIGN=\"center\"><A HREF=\"/cgi-bin/uncgi/fortune-cgi?PROCID=$procid&TASK=SAME\">Stop!</A>";
print "<TD ALIGN=\"center\"><A HREF=\"/cgi-bin/uncgi/fortune-cgi?PROCID=$procid&TASK=STOP\">Hawk Home</A>";
print '</TR></TABLE><HR><CENTER>';
if ($task eq "SAME") {
  print ("STOPPED!<BR>Click \"Another Cookie\" to resume cookie cycling.");
    } else {
  print ("This page will self destruct shortly...........");
  }
print ("</CENTER></BODY></HTML>\n");
}
