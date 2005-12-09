<html>
<BODY BGCOLOR="White" TEXT="Black" LINK="Blue" VLINK="Purple" ALINK="Black">

<!sql if ?Record="">
 <H1><center> You Must type a Record, press Back </center></h1>
<!sql else>

<! sql connect >
<! sql database biblioteca >
<! sql query "delete from libri where oid=$Record">

<CENTER>
<FONT SIZE=+4>
COMPLETED
<P>
<A HREF="../books.html">HOME</A>
</CENTER>

<BR>
<!sql close>
<!sql endif>
</body>
</html>
