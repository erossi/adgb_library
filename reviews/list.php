<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<?php if (file_exists('../procedure/review_head.php')) { include '../procedure/review_head.php'; } ?>

<!-- Header -->
<TABLE BGCOLOR="#000000" WIDTH="100%" CELLSPACING="1" CELLPADDING="2" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">
    &nbsp;Navigate: <A HREF="../index.php">Home Page</A> : <A HREF="reviews.php">Reviews</A>
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Reviews List</H2></CENTER>

<?php
    // connessione al database
    if (file_exists('../procedure/connect_db.php')) { include '../procedure/connect_db.php'; }
    
    // leggo gli articoli
    $query="SELECT count(*) FROM articoli";
    $result = pg_Exec ($conn,$query);
    if (!$result) {
        print 'An error occured.\n';
        exit;
    };
    if ($DEBUG) { print 'Query lanciata: <B>' . $query . '</B><BR>'; };
    
    // conto il numero di linee trovate (count ritorna sempre qualcosa).
    $arr=pg_fetch_array ($result,0);
    $num_rows=$arr[0];
    if ($DEBUG) { print 'Totale libri trovati: ' . $num_rows . '<BR>'; };
    
    // imposto i limiti dei record da stampare (stampo da $from a $to).
    if ($from == "") { $from=0; };
    if ($to == "") { $to=$to+$max_table_rows-1; };
    if ($DEBUG) { print 'Indici: <B>from=' . $from . ', to=' . $to . '</B>'; };
        
    // stampo l'indice
    print '<TABLE CELLSPACING="1" CELLPADDING="2" BORDER="0" WIDTH="100%">';
    print '<TR BGCOLOR="Black">';
    print '<TD  WIDTH="5%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Num.</FONT></TD>';
    print '<TD WIDTH="95%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">&nbsp;';
   
    for ($count=0; $count<$num_rows; $count+=$max_table_rows) {
        $temp_to=$count+$max_table_rows-1;
        if ($temp_to>$num_rows) { $temp_to=$num_rows-1; };
        print '<A HREF="list.php?from=' . $count . '&to=' . $temp_to . '">' . $count . '</A> &nbsp;';
    }
    print '</FONT></TD></TR></TABLE>';
    
    // stampo il risultato
    $query="SELECT * FROM articoli";
    $result=pg_exec($conn,$query);
    if (!$result) {
        print 'An error occured.\n';
        exit;
    };
    if ($DEBUG) { print 'Query lanciata: <B>' . $query . '</B><BR>'; };
    
    // conto il numero di righe
    $num_rows=pg_numrows($result);
    if ($DEBUG) { print 'Numero righe della tabella: <B>' . $num_rows . '</B><BR>'; };
    
    print '<TABLE CELLSPACING="1" CELLPADDING="2" BORDER="0" WIDTH="100%">';
    print '<TR BGCOLOR="Black">';
    print '<TD><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Num.</FONT></TD>';
    print '<TD><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Articolo</FONT></TD>';    
    for ($count=$from; $count<=$to; $count++)
    {
        $arr=pg_fetch_array ($result, $count);
        if (($count % 2) == 0) {
            print '<TR BGCOLOR="#33CC99">';
        } else {
            print '<TR BGCOLOR="White">';
        };
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $count . '</FONT></TD>';
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $arr['articolo'] . '</FONT></TD>';
        print "</TR>";
    };
    print '</TABLE>';

    // chiudo la connessione
    pg_close ($conn);
?>

<?php if (file_exists('../procedure/review_tail.php')) { include '../procedure/review_tail.php'; } ?>

</BODY>
</HTML>