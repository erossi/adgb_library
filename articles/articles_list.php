<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><?php print $prog_name; ?> - Articles</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<!-- header -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left">
    <font face="arial,helvetica,sans-serif" size="2">
    &nbsp;Navigate: <a href="../contents.php" target="contents">Home page</a> : <a href="articles_index.php" target="contents">Articles</a> : Articles list
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Articles list</h2></center>

<?php
    // controllo i parametri
    if ($DEBUG) { 
        print 'string 1 is: ' . $string1 . '<br>';
        print 'logical op 1 is: ' . $op1 . '<br>';
        print 'string 2 is: ' . $string2 . '<br>';
        print 'logical op 2 is: ' . $op2 . '<br>';
        print 'string 3 is: ' . $string3 . '<br>';
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
        print 'The where is: ' . $where . '<br>';
        print 'The where encoded is: ' . $where_encoded . '<br>';
    };        
        
    // if there is something we add "where " at the where clause
    if ($where) { $where_clause="WHERE " . $where; };
    if ($DEBUG) { print 'The where clause is: ' . $where_clause . '<br>'; };        

    // connessione al database
    if (file_exists('../procedure/connect_db.php')) { include '../procedure/connect_db.php'; }

    // leggo gli articoli
    $query="SELECT count(*) FROM articoli " . $where_clause;
    $result = pg_exec ($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($DEBUG) { print 'file articles_list error: cannot execute query.\n'; };
        exit;
    };
    
    // conto il numero di linee trovate (count ritorna sempre qualcosa).
    $arr=pg_fetch_array ($result,0);
    $num_rows=$arr[0];
    if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

    if ($num_rows=='0') {
        print '<ul>';
        print '    <li>No articles found.';
        print '</ul>';
    } else {
        // legenda
        print '<div align="right">';
        print '&nbsp;<img src="../icone/ico_edit.gif" width="17" height="15" border="0"> = Edit&nbsp;';
        print '&nbsp;<img src="../icone/ico_delete.gif" width="17" height="15" border="0"> = Delete&nbsp;';
        print '</div>';
        
        // stampo l'indice
        print '<table cellspacing="1" cellpadding="2" border="0" width="100%">';
        print '<tr bgcolor="black">';
        print '<td  width="5%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Num.</font></td>';
        print '<td width="95%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">&nbsp;';
       
        for ($count=0; $count<$num_rows; $count+=$max_table_rows) {
            $temp_to=$count+$max_table_rows-1;
            if ($temp_to>$num_rows) { $temp_to=$num_rows-1; };
            print '<a href="articles_list.php?from=' . $count . '&to=' . $temp_to . '&where=' . $where_encoded . '">' . $count . '</a> &nbsp;';
        }
        print ': Total ' . $num_rows;
        print '</font></td></tr></table>';
        
        // stampo il risultato
        $query="SELECT oid,* FROM articoli " . $where_clause;
        $result = pg_exec ($conn,$query);
        if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        if (!$result) {
            if ($DEBUG) { print 'file articles_list error: cannot execute query.\n'; };
            exit;
        };
       
        // conto il numero di righe
        $num_rows=pg_numrows($result);
        if ($DEBUG) { print 'Numbers of rows in table: <b>' . $num_rows . '</b><br>'; };
    
        // imposto i limiti dei record da stampare (stampo da $from a $to).
        if ($from=='') { $from=0; };
        if ($to=='') { $to=$to+$max_table_rows-1; };
        // you cannot exceed number of row reported by database.
        if ($to>$num_rows) { $to=$num_rows-1; };
        if ($DEBUG) { print 'Index: <b>from=' . $from . ', to=' . $to . '</b>'; };
    
        print '<table cellspacing="1" cellpadding="2" border="0" width="100%">';
        print '<tr bgcolor="black">';
        print '<td width="5%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Num.</font></td>';
        print '<td><font face="arial,helvetica,sans-serif" size="2" style="color: white">Article description</font></td>';
        print '<td width="10%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Operation</font></td>';
        for ($count=$from; $count<=$to; $count++)
        {
            $arr=pg_fetch_array ($result, $count);
            if (($count % 2) == 0) {
                print '<tr bgcolor="#33cc99">';
            } else {
                print '<tr bgcolor="white">';
            };
            print '<td valign="top"><font face="arial,helvetica,sans-serif" size="2">' . $count;
            if ($DEBUG) {
                print '<br><i>' . $arr['oid'] . '</i>';
            }
            print '</font></td>';
            print '<td valign="top"><font face="arial,helvetica,sans-serif" size="2">' . $arr['articolo'] . '</font></td>';
            print '<td valign="top">';
            print '    <a href="secure/articles_modify.php?oid=' . $arr['oid'] . '&where=' . $where_encoded . '"><img src="../icone/ico_edit.gif" width="17" height="15" border="0">';
            print '    <a href="secure/articles_delete.php?oid=' . $arr['oid'] . '&where=' . $where_encoded . '"><img src="../icone/ico_delete.gif" width="17" height="15" border="0">';
            print '</td>';
            print '</tr>';
        };
        print '</table>';
    }
    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>