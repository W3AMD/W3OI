#!/usr/bin/perl
#Setup environment
$maxindex="5";
$name=$ENV{'WWW_name'};
$call=$ENV{'WWW_call'};
$email=$ENV{'WWW_email'};
$medium=$ENV{'WWW_med'};
$large=$ENV{'WWW_lrg'};
$xlarge=$ENV{'WWW_xlg'};
$xxlarge=$ENV{'WWW_xxl'};
$paytype=$ENV{'WWW_paytype'};
$comments=$ENV{'WWW_comments'};
$outfile="./shirt-db.txt";
$src_ip=$ENV{'REMOTE_ADDR'};
$src_host=$ENV{'REMOTE_HOST'};
$browser=$ENV{'HTTP_USER_AGENT'};
$tot_pay=((12 * ($medium+$large+$xlarge)) + (14 * $xxlarge));

#Check for a name or a callsign
if ( $name gt "" || $call gt "" ) {

#Post to database 
$currtime=time();
$timestrg=(localtime($currtime));

open (OUTFILE, ">>$outfile");
print (OUTFILE "On: $timestrg\n");
print (OUTFILE "From:$src_ip:$src_host:$browser\n");
print (OUTFILE "Data:$currtime:$name:$call:$medium:$large:$xlarge:$xxlarge:$paytype:$tot_pay:$email:$comments:\n\n");
close OUTFILE;

#Send me mail
open (OUTFILE, "|mail Paul.Ryan\@USA.NET -s \"T-Shirts/$name/$call\"");
print OUTFILE ("Feedback on $timestrg from $src_host at $src_ip\n");
print OUTFILE ("for $name at $email with a call of $call  using $browser.\n");
print OUTFILE ("Medium=$medium, Large=$large, XLarge=$xlarge, XXLarge=$xxlarge\n");
print OUTFILE ("Comments: $comments \n");
close OUTFILE ;

#Send them mail
if ($email gt "" ){
open (OUTFILE, "|mail $email -s \"T-Shirts for $name $call\"");
print OUTFILE "Thanks $name ";
if ( $call gt "" ) { print OUTFILE "($call) "; } 
print OUTFILE "for your order!\n";
print OUTFILE "Remember to get your \$";
printf OUTFILE "%6.2f ", $tot_pay  ;
print OUTFILE "payment to:\n";
print OUTFILE "  Paul F. Ryan\n   LVARC Treasurer\n";
print OUTFILE "  5814 Lindbergh St.\n";
print OUTFILE "  Orefield, PA  18069-2250\n";
#print OUTFILE "before May 25th if you want yours to be in the first\n";
#print OUTFILE "batch ordered and have your shirt for Field Day.\n";
print OUTFILE "\nYou ordered as follows:\n";
print OUTFILE ("Medium=$medium, Large=$large, XLarge=$xlarge, XXLarge=$xxlarge\n");
print OUTFILE ("Your Comments: $comments \n");
print OUTFILE "\n73, \nN0KIA\n\n";
print OUTFILE "If you need to cancel or query about an order, send mail to:\n";
print OUTFILE '  Paul.Ryan@USA.NET';
print oUTFILE "\n\n";
close OUTFILE ;
}

#Print thank-you form 

print "Content-type: text/html\n\n";
print '<HTML><HEAD>';
print '<TITLE>T-Shirt Order:  Thank You</TITLE>';
print '</HEAD><BODY BACKGROUND="/graphics/paper4.jpeg">';
print '<H1>Thanks for your order!</H1>';
print "<P>Thank you $name ";
if ( $call gt "" ) { print "($call) "; }
print "for your order.  Remember to get your<B> \$";
printf "%6.2f ", $tot_pay  ;
print "</B>payment to:";
print "<blockquote><b>  Paul F. Ryan<br>LVARC Treasurer<br>";
print "  5814 Lindbergh St.<br>";
print "  Orefield, PA  18069-2250";
print "</blockquote></b>";
#print 'before May 25th if you want yours to be in the first batch ordered and ';
#print 'have your shirt for Field Day.</P>';
print "<P>You ordered as follows:<BR>";
print '<TABLE BORDER="2" BORDERCOLOR="BLACK" WIDTH="25%" BGCOLOR="#ffebcd"><TD>';
print "<TR><TD>Medium:<TD>$medium<BR></TR>";
print "<TR><TD>Large:<TD>$large<BR></TR>";
print "<TR><TD>XLarge:<TD>$xlarge<BR></TR>";
print "<TR><TD>XXLarge:<TD>$xxlarge<BR></TR>";
print "</TABLE>";
print "Comments:\n $comments<BR>";
print '<HR><CENTER><A HREF="http://members.spree.com/technology/w3oi/main.htm">Back</A> to W3OI</CENTER>';
print "</BODY></HTML>\n\n";

} else {


#Print rejection form 

print "Content-type: text/html\n\n";
print '<HTML><HEAD>';
print '<TITLE>T-Shirt Order:  Rejection</TITLE>';
print '</HEAD><BODY BACKGROUND="/graphics/paper4.jpeg">';
print '<CENTER><H1>Sorry!</H1></CENTER>';
print "<P>We need at least an identifiable name, callsign or club A/P ID to ";
print "process an order.  Use your browser's BACK button ( or ALT <-- ) to fill in the ";
print "missing information and resubmit.";
print '<p>You ordered as follows:<BR>';
print '<TABLE WIDTH="25%" BGCOLOR="#ffebcd"><TD>';
print "<TR><TD>Medium:<TD>$medium<BR></TR>";
print "<TR><TD>Large:<TD>$large<BR></TR>";
print "<TR><TD>XLarge:<TD>$xlarge<BR></TR>";
print "<TR><TD>XXLarge:<TD>$xxlarge<BR></TR>";
print "</TABLE>";
print "Comments:\n $comments<BR>";
print '<HR><CENTER><A HREF="http://members.spree.com/technology/w3oi/main.htm">Back</A> to W3OI</CENTER>';
print "</BODY></HTML>\n\n";

}
