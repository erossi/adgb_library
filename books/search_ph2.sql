<html>
<BODY BGCOLOR="White" TEXT="Black" LINK="Blue" VLINK="Purple" ALINK="Black">

<!sql setdefault Query "">

<!sql if ?Record="">
 <H1><center> You Must type a Record, press Back </center></h1>
<!sql else>

<! sql connect >
<! sql database biblioteca >
<! sql query "select * from libri where oid=$Record" q1>

 <! sql qlongform q1>

<center>
<FONT SIZE=+2>
<! sql print "<A HREF=\"secure/delete_ph2.sql\?Record=#Record\">DELETE</A>">
<! sql print "<A HREF=\"secure/modify_ph2.sql\?Record=#Record\">MODIFY</A>">
<A HREF="search.html">BACK</A>
</FONT>
</center>

<! sql free q1>
<!sql close>
<!sql endif>
</body>
</html>
