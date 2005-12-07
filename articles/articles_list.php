<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
<HEAD>
    <TITLE>Library - Articles</TITLE>
    <LINK REL="STYLESHEET" HREF="../library.css">
</HEAD>
<BODY TEXT="Black" BGCOLOR="White" LINK="#CC9966" ALINK="#CC9966" VLINK="#CC9966">

<!-- Header -->
<TABLE WIDTH="100%" CELLSPACING="0" CELLPADDING="0" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
    &nbsp;Navigate: <A HREF="../contents.php" TARGET="contents">Home Page</A> : <A HREF="articles_index.php" TARGET="contents">Articles</A> : Articles list
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Articles List</H2></CENTER>

<?php
    // controllo i parametri
    if ($DEBUG) { 
        print 'String 1 is: ' . $string1 . '<BR>';
        print 'Logical op 1 is: ' . $op1 . '<BR>';
        print 'String 2 is: ' . $string2 . '<BR>';
        print 'Logical op 2 is: ' . $op2 . '<BR>';
        print 'String 3 is: ' . $string3 . '<BR>';
    };
    // string control
    if (!$where) {
        if ($string1) { $where="articolo ~* '$string1'"; };
        if ($string2) {
            if ($where) {
                $where=$where . " " . $op1 . " articolo ~* '$string2'";
            } else {
                $where="articolo ~* '$string2'";
            };
        };
        if ($string3) {
            if ($where) {
                $where=$where . " " . $op2 . " articolo ~* '$string3'";
            } else {
                $where="articolo ~* '$string3'";
            };
        };
    }
    
    $where=stripslashes($where);
        
    $where_encoded=urlencode($where);
    if ($DEBUG) { 
        print 'The where is: ' . $where . '<BR>';
        print 'The where encoded is: ' . $where_encoded . '<BR>';
    };        
        
    // if there is something we add "WHERE " at the where clause
    if ($where) { $where_clause="WHERE " . $where; };
    if ($DEBUG) { print 'The where clause is: ' . $where_clause . '<BR>'; };        

    // connessione al database
    if (file_exists('../procedure/connect_db.php')) { include '../procedure/connect_db.php'; }

    // leggo gli articoli
    $query="SELECT count(*) FROM articoli " . $where_clause;
    $result = pg_Exec ($conn,$query);
    if ($DEBUG) { print 'Query: <B>' . $query . '</B><BR>'; };
    if (!$result) {
        if ($DEBUG) { print 'File articles_list error: cannot execute query.\n'; };
        exit;
    };
    
    // conto il numero di linee trovate (count ritorna sempre qualcosa).
    $arr=pg_fetch_array ($result,0);
    $num_rows=$arr[0];
    if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<BR>'; };

    if ($num_rows=='0') {
        print '<UL>';
        print '    <LI>No articles found.';
        print '</UL>';
    } else {
        // stampo l'indice
        print '<TABLE CELLSPACING="1" CELLPADDING="2" BORDER="0" WIDTH="100%">';
        print '<TR BGCOLOR="Black">';
        print '<TD  WIDTH="5%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Num.</FONT></TD>';
        print '<TD WIDTH="95%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">&nbsp;';
       
        for ($count=0; $count<$num_rows; $count+=$max_table_rows) {
            $temp_to=$count+$max_table_rows-1;
            if ($temp_to>$num_rows) { $temp_to=$num_rows-1; };
            print '<A HREF="articles_list.php?from=' . $count . '&to=' . $temp_to . '&where=' . $where_encoded . '">' . $count . '</A> &nbsp;';
//            '&string1=' . $string1 . '&op1=' . $op1 . '&string2=' . $string2 . '&op2=' . $op2 . '&string3=' . $string3 . '">' . $count . '</A> &nbsp;';
        }
        print ': Total ' . $num_rows;
        print '</FONT></TD></TR></TABLE>';
        
        // stampo il risultato
        $query="SELECT oid,* FROM articoli " . $where_clause;
        $result = pg_Exec ($conn,$query);
        if ($DEBUG) { print 'Query: <B>' . $query . '</B><BR>'; };
        if (!$result) {
            if ($DEBUG) { print 'File articles_list error: cannot execute query.\n'; };
            exit;
        };
       
        // conto il numero di righe
        $num_rows=pg_numrows($result);
        if ($DEBUG) { print 'Numbers of rows in table: <B>' . $num_rows . '</B><BR>'; };
    
        // imposto i limiti dei record da stampare (stampo da $from a $to).
        if ($from=='') { $from=0; };
        if ($to=='') { $to=$to+$max_table_rows-1; };
        // you cannot exceed number of row reported by database.
        if ($to>$num_rows) { $to=$num_rows-1; };
        if ($DEBUG) { print 'Index: <B>from=' . $from . ', to=' . $to . '</B>'; };
    
        print '<TABLE CELLSPACING="1" CELLPADDING="2" BORDER="0" WIDTH="100%">';
        print '<TR BGCOLOR="Black">';
        print '<TD WIDTH="5%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Num.</FONT></TD>';
        print '<TD><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Article</FONT></TD>';
        print '<TD WIDTH="10%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Operation</FONT></TD>';
        for ($count=$from; $count<=$to; $count++)
        {
            $arr=pg_fetch_array ($result, $count);
            if (($count % 2) == 0) {
                print '<TR BGCOLOR="#33CC99">';
            } else {
                print '<TR BGCOLOR="White">';
            };
            print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $count;
            if ($DEBUG) {
                print '<BR><I>' . $arr['oid'] . '</I>';
            }
            print '</FONT></TD>';
            print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $arr['articolo'] . '</FONT></TD>';
            print '<TD VALIGN="TOP">';
            print '    <A HREF="secure/articles_modify.php?oid=' . $arr['oid'] . '&where=' . $where_encoded . '"><IMG SRC="../icone/ico_edit.gif" WIDTH="17" HEIGHT="15" BORDER="0">';
            print '    <A HREF="secure/articles_delete.php?oid=' . $arr['oid'] . '&where=' . $where_encoded . '"><IMG SRC="../icone/ico_delete.gif" WIDTH="17" HEIGHT="15" BORDER="0">';            
            print '</TD>';
            print '</TR>';
        };
        print '</TABLE>';
    }
    // chiudo la connessione
    pg_close ($conn);
?>

</BODY>
</HTML>