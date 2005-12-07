<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><?php print $prog_name; ?> - Books</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<!-- header -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left">
    <font face="arial,helvetica,sans-serif" size="2">
    &nbsp;Navigate: <a href="../contents.php" target="contents">Home page</a> : <a href="books_index.php" target="contents">Books</a> : Books list
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Books list</h2></center>

<?php
    // controllo i parametri
    if ($DEBUG) { 
        print 'title(info) is: ' . $title . '(' . $info . ')<br>';
        print 'aut 1 is: ' . $aut1 . '<br>';
        print 'aut 2 is: ' . $aut2 . '<br>';
        print 'aut 3 is: ' . $aut3 . '<br>';
        print 'editor is: ' . $editor . '<br>';
        print 'shelf/number is: ' . $shelf . ', ' . $number . '<br>';
        print 'logical op 1 is: ' . $logical_op . '<br>';
    };
    // string control: crea la where clause
    if (!$where) {
        if ($title) { $where="titolo ~* '$title'"; };
        if ($info) {
            if ($where) {
                $where=$where . " " . $logical_op . " info ~* '$info'";
            } else {
                $where="info ~* '$info'";
            };
        };
        if ($aut1) {
            if ($where) {
                $where=$where . " " . $logical_op . " aut1 ~* '$aut1'";
            } else {
                $where="aut1 ~* '$aut1'";
            };
        };
        if ($aut2) {
            if ($where) {
                $where=$where . " " . $logical_op . " aut2 ~* '$aut2'";
            } else {
                $where="aut2 ~* '$aut2'";
            };
        };
        if ($aut3) {
            if ($where) {
                $where=$where . " " . $logical_op . " aut3 ~* '$aut3'";
            } else {
                $where="aut3 ~* '$aut3'";
            };
        };
        if ($editor) {
            if ($where) {
                $where=$where . " " . $logical_op . "editor ~* '$editor'";
            } else {
                $where="casa_editoriale ~* '$editor'";
            };
        };
        if ($shelf) {
            if ($where) {
                $where=$where . " " . $logical_op . "shelf ~* '$shelf'";
            } else {
                $where="scaffale ~* '$shelf'";
            };
        };
        if ($number) {
            if ($where) {
                $where=$where . " " . $logical_op . "number ~* '$number'";
            } else {
                $where=" number~* '$number'";
            };
        };
    };
    
    // toglie tutti gli slashes 
    $where=stripslashes($where);
    
    // codifica la where clause per poterla trasferire via URL
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
    $query="SELECT count(*) FROM libri " . $where_clause;
    $result = pg_exec ($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($DEBUG) { print 'file books_list error: cannot execute query.\n'; };
        exit;
    };
    
    // conto il numero di linee trovate (count ritorna sempre qualcosa).
    $arr=pg_fetch_array ($result,0);
    $num_rows=$arr[0];
    if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

    if ($num_rows=='0') {
        print '<ul>';
        print '    <li>No books found.';
        print '</ul>';
    } else {
        // stampo l'indice
        print '<table cellspacing="1" cellpadding="2" border="0" width="100%">';
        print '<tr bgcolor="black">';
        print '<td  width="5%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Num.</font></td>';
        print '<td width="95%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">&nbsp;';
       
        for ($count=0; $count<$num_rows; $count+=$max_table_rows) {
            $temp_to=$count+$max_table_rows-1;
            if ($temp_to>$num_rows) { $temp_to=$num_rows-1; };
            print '<a href="books_list.php?from=' . $count . '&to=' . $temp_to . '&where=' . $where_encoded . '">' . $count . '</a> &nbsp;';
        }
        print ': Total ' . $num_rows;
        print '</font></td></tr></table>';

        // legenda
        print '<table cellspacing="1" cellpadding="2" border="0" width="100%">';
        print '<tr>';
        print '<td align="right" valign="middle" bgcolor="white">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
        print '    &nbsp;Anyone:';
        print '    </font>';
        print '</td>';
        print '<td align="left" valign="middle" bgcolor="#00ff00">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
        print '    &nbsp;<img src="../icone/ico_info.gif" width="17" height="15" border="0" align="absmiddle"> = Info&nbsp;';
        print '    </font>';
        print '</td>';
        print '<td align="right" valign="middle" bgcolor="white">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
        print '    &nbsp;<img src="../icone/ico_protected.gif" width="45" height="15" border="0" hspace="5" align="absmiddle" alt="This links are password protected" align="absmiddle">&nbsp;Password protected: ';
        print '    </font>';
        print '</td>';
        print '<td align="left" valign="middle" bgcolor="#ffaa80">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
/*        print '    &nbsp;<img src="../icone/ico_draw.gif" width="15" height="15" border="0" align="absmiddle"> = Draw&nbsp;';
        print '    &nbsp;<img src="../icone/ico_deposit.gif" width="14" height="15" border="0" align="absmiddle"> = Deposit&nbsp;';*/
        print '    &nbsp;<img src="../icone/ico_history.gif" width="14" height="15" border="0" align="absmiddle"> = History&nbsp;';
        print '    &nbsp;<img src="../icone/ico_edit.gif" width="20" height="15" border="0" align="absmiddle"> = Edit&nbsp;';
        print '    &nbsp;<img src="../icone/ico_delete.gif" width="17" height="15" border="0" align="absmiddle"> = Delete&nbsp;';
        print '    </font>';
        print '</td>';
        print '</tr>'; 
        print '</table>';

        // stampo il risultato
        $query="SELECT oid,* FROM libri " . $where_clause;
        $result = pg_exec ($conn,$query);
        if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        if (!$result) {
            if ($DEBUG) { print 'file books_list error: cannot execute query.\n'; };
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
        print '<td width="80%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Book description</font></td>';
        print '<td width="15%" colspan="2"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Operation</font></td>';
        for ($count=$from; $count<=$to; $count++)
        {
            $arr=pg_fetch_array ($result, $count);
            if (($count % 2) == 0) {
                print '<tr bgcolor="#33cc99">';
            } else {
                print '<tr bgcolor="white">';
            };

            // first column
            print '<td valign="top"';
            if ($arr['presente'] == 'f') { 
                print ' background=' . (($count % 2) == 0 ? '"../icone/back_drown_green.gif"' : '"../icone/back_drown_white.gif"') . '>';
            } else {
                print '>';
            }
            print '    <font face="arial,helvetica,sans-serif" size="2">';
            print $count . '<br>';
            if ($arr['presente'] == 'f') { print '<i>Drawn</i><br>'; }
            if ($DEBUG) { print '<i>' . $arr['oid'] . '</i>'; }
            print '    </font>';
            print '</td>';

            // second column
            print '<td valign="top"';
            if ($arr['presente'] == 'f') { 
                print ' background=' . (($count % 2) == 0 ? '"../icone/back_drown_green.gif"' : '"../icone/back_drown_white.gif"') . '>';
            } else {
                print '>';
            }
            print '    <font face="arial,helvetica,sans-serif" size="2">';
            print '    <i>' . $arr['titolo'] . '</i>';
            if ($arr['info'] != "") { print '&nbsp;(' . $arr['info'] . ')'; }
            print '<br>' . $arr['aut1'];
            if ($arr['aut2'] != "") { print ',&nbsp;' . $arr['aut2']; }
            if ($arr['aut3'] != "") { print ',&nbsp;' . $arr['aut3']; }
            if ($arr['aut4'] != "") { print ',&nbsp;' . $arr['aut4']; }
            if ($arr['aut5'] != "") { print ',&nbsp;' . $arr['aut5']; }
            if ($arr['aut6'] != "") { print ',&nbsp;' . $arr['aut6']; }
            if ($arr['aut7'] != "") { print ',&nbsp;' . $arr['aut7']; }
            print '    <br><u>' . $arr['casa_editoriale'] . '</u>';
            print '    </font>';
            print '</td>';
            print '<td valign="top" bgcolor="#00ff00">';
            print '    <a href="books_info.php?oid=' . $arr['oid'] . '"><img src="../icone/ico_info.gif" width="17" height="15" border="0" alt="View detailed information for this book"></a>';
/*            if ($arr['presente'] == 'f') {
                print '    <img src="../icone/ico_deposit.gif" width="14" height="15" border="0">';
            } else {
                print '    <img src="../icone/ico_draw.gif" width="15" height="15" border="0">';
            }*/
            print '</td>';
            print '<td valign="top" bgcolor="#ffaa80">';
            print '    <a href="secure/books_history.php?shelf=' . $arr['scaffale'] . '&num=' . $arr['numero'] . '"><img src="../icone/ico_history.gif" width="14" height="15" border="0" alt="View history for this book"></a>';
            print '    <a href="secure/books_modify.php?oid=' . $arr['oid'] . '"><img src="../icone/ico_edit.gif" width="20" height="15" border="0" alt="Modify information for this book"></a>';
            print '    <a href="secure/books_delete.php?oid=' . $arr['oid'] . '"><img src="../icone/ico_delete.gif" width="17" height="15" border="0" alt="Delete this book"></a>';
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
