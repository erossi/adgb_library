<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<?php if (file_exists('../procedure/book_head.php')) { include '../procedure/book_head.php'; } ?>

<!-- Header -->
<TABLE BGCOLOR="#000000" WIDTH="100%" CELLSPACING="1" CELLPADDING="2" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">
    &nbsp;Navigate: <A HREF="../index.php">Home Page</A> : <A HREF="books.php">Books</A> : Books list
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Books List</H2></CENTER>

<?php
    // connessione al database
    if (file_exists('../procedure/connect_db.php')) { include '../procedure/connect_db.php'; }
    
    // leggo gli articoli
    $query="SELECT count(*) FROM libri";
    $result = pg_Exec ($conn,$query);
    if ($DEBUG) { print 'Query: <B>' . $query . '</B><BR>'; };
    if (!$result) {
        if ($DEBUG) { print 'File books_list error: cannot execute query.\n'; };
        exit;
    };
    
    // conto il numero di linee trovate (count ritorna sempre qualcosa).
    $arr=pg_fetch_array ($result,0);
    $num_rows=$arr[0];
    if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<BR>'; };
    
    // imposto i limiti dei record da stampare (stampo da $from a $to).
    if ($from == "") { $from=0; };
    if ($to == "") { $to=$to+$max_table_rows-1; };
    if ($DEBUG) { print 'Index: <B>from=' . $from . ', to=' . $to . '</B>'; };
        
    // stampo l'indice
    print '<TABLE CELLSPACING="1" CELLPADDING="2" BORDER="0" WIDTH="100%">';
    print '<TR BGCOLOR="Black">';
    print '<TD  WIDTH="5%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Num.</FONT></TD>';
    print '<TD WIDTH="95%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">&nbsp;';
   
    for ($count=0; $count<$num_rows; $count+=$max_table_rows) {
        $temp_to=$count+$max_table_rows-1;
        if ($temp_to>$num_rows) { $temp_to=$num_rows-1; };
        print '<A HREF="books_list.php?from=' . $count . '&to=' . $temp_to . '">' . $count . '</A> &nbsp;';
    }
    print '</FONT></TD></TR></TABLE>';
    
    // stampo il risultato
    $query="SELECT * FROM libri";
    $result = pg_Exec ($conn,$query);
    if ($DEBUG) { print 'Query: <B>' . $query . '</B><BR>'; };
    if (!$result) {
        if ($DEBUG) { print 'File books_list error: cannot execute query.\n'; };
        exit;
    };
   
    // conto il numero di righe
    $num_rows=pg_numrows($result);
    if ($DEBUG) { print 'Numbers of rows in table: <B>' . $num_rows . '</B><BR>'; };
    
    print '<TABLE CELLSPACING="1" CELLPADDING="2" BORDER="0" WIDTH="100%">';
    print '<TR BGCOLOR="Black">';
    print '<TD WIDTH="5%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Num.</FONT></TD>';
    print '<TD WIDTH="5%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Number</FONT></TD>';
    print '<TD><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Title</FONT></TD>';
    print '<TD><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">1st. Author</FONT></TD>';
    print '<TD><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Editor</FONT></TD>';
    for ($count=$from; $count<=$to; $count++)
    {
        $arr=pg_fetch_array ($result, $count);
        if (($count % 2) == 0) {
            print '<TR BGCOLOR="#33CC99">';
        } else {
            print '<TR BGCOLOR="White">';
        };
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $count . '</FONT></TD>';
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $arr['numero'] . '</FONT></TD>';
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $arr['titolo'] . '</FONT></TD>';
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $arr['aut1'] . '</FONT></TD>';
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $arr['casa_editoriale'] . '</FONT></TD>';
        print '</TR>';
    };
    print '</TABLE>';

    // chiudo la connessione
    pg_close ($conn);
?>

</BODY>
</HTML>