#!/usr/bin/perl
$infile="./shirt-db.txt";
$password = $ENV{'WWW_passwd'};
$srchstrg = "Data";
$rsltstrg="";

print ("Content-type: text/html\n\n");
print ("<HTML><HEAD><TITLE>Shirt List Form</TITLE></HEAD>\n");
#print ("<BODY BACKGROUND=\"/graphics/paper4.jpeg\">\n");
print ("<BODY bgcolor=\"aqua\">\n");

#if ($password eq "anders0n") {

#print "<TABLE BORDER=3 frame=box framecolor=black  bgcolor=\"yellow\" WIDTH=\"100%\"><TR>";
print "<TABLE BORDER=3 frame=box bgcolor=\"yellow\" WIDTH=\"100%\"><TR>";
print "<TH width=\"5%\">M</TH><TH width=\"5%\">L</TH><TH width=\"5%\">X</TH>";
print "<TH width=\"5%\">XX</TH><TH width=\"25%\">Name</TH><TH width=\"12%\">Call</TH>";
print "<TH width=\"10%\">Paid</TH><TH>Comment</TH>";


if (open (XREFFILE, $infile )) {
    while ($line = <XREFFILE>)  {
        chop ($line);
	@ARRAY1 = split (/:/, $line);
	if ($ARRAY1[0] eq $srchstrg ) {
		if ($ARRAY1[4] eq "0") {
			$ARRAY1[4] = "&nbsp;"
		}
		if ($ARRAY1[5] eq "0") {
			$ARRAY1[5] = "&nbsp;"
		}
		if ($ARRAY1[6] eq "0") {
			$ARRAY1[6] = "&nbsp;"
		}
		if ($ARRAY1[7] eq "0") {
			$ARRAY1[7] = "&nbsp;"
		}
		print ("<TR border=\"2\">");
		print ("<TD align=center border=\"2\">$ARRAY1[4]");
		print ("<TD align=center border=\"2\">$ARRAY1[5]");
		print ("<TD align=center border=\"2\">$ARRAY1[6]");
		print ("<TD align=center border=\"2\">$ARRAY1[7]");
		print ("<TD border=\"2\">$ARRAY1[2]");
		print ("<TD border=\"2\">$ARRAY1[3]");
		if ($ARRAY1[12] eq "*" ) {
			print ("<TD border=\"2\" align=center >Paid");
		}else{
			print ("<TD border=\"2\"> &nbsp; ");
		}
		if ($ARRAY1[13] eq "D" ) {
			print ("<TD border=\"2\" align=center >Delivered");
		}else{
			print ("<TD border=\"2\"> &nbsp; ");
		}
		print ("</TR>\n");
	}
    }  
    close (XREFFILE);

print ("</TABLE>");

}
#}else{
#print ("Wrong!");
#}
print ("</BODY></HTML>\n");
end;
