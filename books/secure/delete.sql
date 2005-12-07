<html>
<BODY BGCOLOR="White" TEXT="Black" LINK="Blue" VLINK="Purple" ALINK="Black">

<!sql setdefault Query "">

<form action="delete_ph2.sql">
<BR>Record to erase <INPUT TYPE="Text" NAME="Record" SIZE="8" ALIGN="ABSMIDDLE">
<input type="Submit" value="DELETE">
</form>

<!sql if ?Query="">

<!sql if ?Autore>
 <!sql set Query "aut1 = '?Autore'">
<!sql else>

 <!sql if ?Titolo>
  <!sql set Query "titolo = '?Titolo'">
 <!sql else>

  <!sql if ?Scaffale>
   <!sql set Query "scaffale = '?Scaffale'">
  <!sql else>

   <!sql if ?Numero>
    <!sql set Query "numero = ?Numero">
   <!sql endif>
  <!sql endif>
 <!sql endif>
<!sql endif>

<!sql if ?Query>

 <!sql if ?Autore>
  <!sql set Query "$Query and aut1 = '?Autore'">
 <!sql endif>

 <!sql if ?Titolo>
  <!sql set Query "$Query and titolo = '?Titolo'">
 <!sql endif>

 <!sql if ?Scaffale>
  <!sql set Query "$Query and scaffale = '?Scaffale'">
 <!sql endif>

 <!sql if ?Numero>
  <!sql set Query "$Query and numero = ?Numero">
 <!sql endif>

<!sql endif>

<!sql endif>

<! sql connect >
<! sql database biblioteca >
<! sql setdefault ofs 1 >
<! sql query "begin" >
<! sql query "declare tmp cursor for
 select oid,scaffale,numero,titolo,aut1
 from libri where
 $Query
 order by scaffale,numero" >
<! sql query "move $ofs in tmp" >
<! sql query "fetch 10 in tmp" q1 >
<! sql if $NUM_ROWS != 0 >

<!-- Put in table -->
<table border width="100%">
<tr>
 <th width="5%">Record</th>
 <th width="5%">Scaffale</th>
 <th width="5%">Numero</th>
 <th width="60%">Titolo</th>
 <th>Autore</th> </tr>

<! sql print_rows q1 "
<tr>
 <td>@q1.0</td> 
 <td>@q1.1</td>
 <td>@q1.2</td>
 <td>@q1.3</td>
 <td>@q1.4</td>
</tr>\n" >

</table>

<!-- Put in navigation links -->
<center>
<! sql if 9 < $ofs >
<! sql print "<a href=\"delete.sql\?Query=#Query&ofs=" >
<! sql eval $ofs - 10 ><! sql print "\">">Prev</a>
<! sql else >
Prev
<! sql endif >

<! sql if $NUM_ROWS = 10 >
<! sql print "<a href=\"delete.sql\?Query=#Query&ofs=" >
<! sql eval $ofs + 10 ><! sql print "\">">Next</a>
<! sql else >
Next
<! sql endif >
</center>
<! sql endif >
<! sql free q1 >
<! sql query "end" >
<p>
</body>
</html>
