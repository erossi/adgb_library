<html>
<BODY BGCOLOR="White" TEXT="Black" LINK="Blue" VLINK="Purple" ALINK="Black">

<!sql setdefault Query "">
<br>
<FONT SIZE=+2><BLINK>
<H1>
<center>
REMEMBER, there is no way to recover a deleted record!!!
</center>
</h1></blink>
</font>
<br>

<!sql if ?Record="">
 <H1><center> You Must type a Record, press Back </center></h1>
<!sql else>

<! sql connect >
<! sql database biblioteca >
<! sql query "select * from libri where oid=$Record" q1>

 <! sql qlongform q1>

<center>
<FONT SIZE=+2><B><BLINK>
<! sql print "<A HREF=\"delete_ph3.sql\?Record=#Record\">DELETE</A>">
</BLINK>
</B> <A HREF="delete.html">CANCEL</A>
</FONT>
</center>

<! sql free q1>
<!sql close>
<!sql endif>
</body>
</html>
