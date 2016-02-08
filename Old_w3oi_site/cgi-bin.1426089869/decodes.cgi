#!/usr/bin/perl
#Setup environment
$src_ip=$ENV{'REMOTE_ADDR'};
$currtime=time();
$timestrg=(localtime($currtime));

#Decode passed variables
$METHOD=$ENV{'REQUEST_METHOD'};
if ( $METHOD eq 'POST' ) {
  read(stdin, $buffer, $ENV{'CONTENT_LENGTH'}); } 
## Won't work on ecomdss server...No GET allowed 
else {
  if ( $METHOD eq 'GET' )  {
     $buffer = $ENV { 'QUERY_STRING' }; }
  else { exit (1); }
}
#Process URL encoded input into keyword/value pairs.
  @pairs = split(/&/, $buffer);
  foreach $pair (@pairs) {
      ($name, $value) = split(/=/, $pair);
      $value =~ tr/+/ /;
      $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
      $ENV{$name} = $value;  }
# Variables may now be dereferenced by $ENV{'varname'}
# End of decode code.

#Print thank-you form 
print "Content-type: text/html\n\n";
print '<HTML><HEAD>';
print '<TITLE>From DECODE.CGI</TITLE>';
print '</HEAD><BODY>';
print "From: $src_ip <br>";
print "At: $timestrg <br>";
print "Comments: $ENV{'komment'} <BR>";

print "METHOD = $METHOD <BR>";
print "buffer = $buffer <BR>";
print "ALPHA = $ENV{'alpha'} <BR>";
print "BRAVO = $ENV{'bravo'} <BR>";
print "CHARLIE = $ENV{'charlie'} <BR>";
print "DELTA = $ENV{'delta'} <BR>";
print "ECHO = $ENV{'echo'} <BR>";

print '<HR><CENTER><A HREF="http://www.w3oi.org/decode.htm">Back</A> to DECODE.HTM</CENTER>';
print "</BODY></HTML>\n\n";

#Send me mail

open (OUTFILE, "|mail pfr2\@lehigh.edu -s \"LVARC Comments\"");
print OUTFILE ("Feedback on $timestrg from $src_host at $src_ip\n");
print OUTFILE ("for $name at $email using $browser.\n");
print OUTFILE ("Comments: $ENV{'komment'} \n");
close OUTFILE ;



