<html>
 <BODY BGCOLOR="White" TEXT="Black" LINK="Blue" VLINK="Purple" ALINK="Black">

<script language="php">

if (!$Query)
{
 if ($Autore)
  $Query="aut1 ~* '$Autore'";
 elseif ($Titolo)
  $Query="titolo ~* '$Titolo'";
 elseif ($Scaffale)
  $Query="scaffale = '$Scaffale'";
 elseif ($Numero)
  $Query="numero = $Numero";
 else
  $Query="Error";

 if ($Titolo)
  $Query="$Query and titolo ~* '$Titolo'";
 if ($Scaffale)
  $Query="$Query and scaffale = '$Scaffale'";
 if ($Numero)
  $Query="$Query and numero = $Numero";

};

$conn = pg_connect("localhost","","","","biblioteca");
if (!$conn)
{
 echo "An error occured.\n";
 exit;
};

$result = pg_Exec ($conn, "
 select oid,scaffale,numero,titolo,aut1
 from libri where $Query
 order by scaffale,numero");

if (!$result)
{
 echo "An error occured.\n";
 exit;
};

echo '<table border width="100%">';

echo '<tr><th width="5%">Scaffale</th><th width="5%">Numero</th>';
echo '<th width="60%">Titolo</th><th>Autore</th></tr>';

$numero_righe=pg_numrows ($result);

for ($i=0; $i<$numero_righe; $i++)
 {
 $arr=pg_fetch_array ($result, $i);
 echo "<tr>";
 echo '<td>',$arr[1],'</td>';
 echo '<td>',$arr[2],'</td>';
 echo '<td><A HREF="search_ph2.sql?Record=',$arr[0],'">';
 echo $arr[3], "</A></td>";
 echo '<td>',$arr[4],'</td>';
 };

echo '</table>';

pg_close ($conn);

</script>
</body>
</html>
