<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Books</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Books list','Home Page','../contents.php','Books','books_index.php'); ?>
<? print_title('Books list'); ?>

<?
    // controllo i parametri
    if ($DEBUG) { 
        print 'title(info) is: ' . $f_title . '(' . $info . ')<br>';
        print 'aut 1 is: ' . $f_aut1 . '<br>';
        print 'aut 2 is: ' . $f_aut2 . '<br>';
        print 'aut 3 is: ' . $f_aut3 . '<br>';
        print 'editor is: ' . $f_editor . '<br>';
        print 'shelf/number is: ' . $f_shelf . ', ' . $f_number . '<br>';
        print 'logical op 1 is: ' . $f_logical_op . '<br>';
    };
    // string control: crea la where clause
    if (!$where) {
        if ($f_title) { $where="titolo ~* '$f_title'"; };
        if ($f_info) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " info ~* '$f_info'";
            } else {
                $where="info ~* '$f_info'";
            };
        };
        if ($f_auth1) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " aut1 ~* '$f_auth1'";
            } else {
                $where="aut1 ~* '$f_auth1'";
            };
        };
        if ($f_auth2) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " aut2 ~* '$f_auth2'";
            } else {
                $where="aut2 ~* '$f_auth2'";
            };
        };
        if ($f_auth3) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " aut3 ~* '$f_auth3'";
            } else {
                $where="aut3 ~* '$f_auth3'";
            };
        };
        if ($f_editor) {
            if ($where) {
                $where=$where . " " . $f_logical_op . "editor ~* '$f_editor'";
            } else {
                $where="casa_editoriale ~* '$f_editor'";
            };
        };
        if ($f_shelf) {
            if ($where) {
                $where=$where . " " . $f_logical_op . "shelf ~* '$f_shelf'";
            } else {
                $where="scaffale ~* '$f_shelf'";
            };
        };
        if ($f_number) {
            if ($where) {
                $where=$where . " " . $f_logical_op . "number ~* '$f_number'";
            } else {
                $where=" number~* '$f_number'";
            };
        };
    };
 
    // toglie tutti gli slashes 
    $where=stripslashes($where);
    // codifica la where clause per poterla trasferire via URL
    $where_encoded=urlencode($where);
    // if there is something we add "where " at the where clause
    if ($where) { $where_clause=" WHERE " . $where; }
    // order by...
    if ($f_order) { $order=$f_order; }
    switch ($order) {
        case "t": $order_clause=" ORDER BY titolo"; break;
        case "c": $order_clause=" ORDER BY collocazione,scaffale,numero"; break;
        default: $order_clause="";
    }

    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);    

    // leggo gli articoli
    $query="SELECT count(*) FROM libri" . $where_clause;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };    
    $result = db_execute($conn,$query);
    
    // conto il numero di linee trovate (count ritorna sempre qualcosa).
    $arr=pg_fetch_array ($result,0);
    $num_rows=$arr[0];
    if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

    if ($num_rows=='0') {
        echo "<ul>\n";
        echo "  <li>No books found.\n";
        echo "</ul>\n";
    } else {
        // stampo l'indice
        echo "<div align=\"center\">\n";
        echo "<table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"90%\">\n";
        echo "<tr bgcolor=\"white\">\n";
        echo "    <td width=\"5%\"><font face=\"arial,helvetica,sans-serif\" size=\"2\">Index:</font></td>\n";
        echo "    <td width=\"95%\"><font face=\"arial,helvetica,sans-serif\" size=\"2\">&nbsp;\n";
        for ($count=0; $count<$num_rows; $count+=$max_table_rows) {
            $temp_to=$count+$max_table_rows-1;
            if ($temp_to>$num_rows) { $temp_to=$num_rows-1; };
            echo "        <a href=\"books_list.php?from=" . $count . "&to=" . $temp_to . "&order=" . $order . "&where=" . $where_encoded . "\">" . $count . "</a> &nbsp;\n";
        }
        echo ": Total " . $num_rows . "\n";
        echo "    </font></td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo "</div>\n";
        
        // legenda
        echo "<div align=\"center\">\n";
        echo "<table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"90%\">\n";        
        echo "<tr>\n";
        echo "<td align=\"left\" valign=\"middle\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        echo "    &nbsp;<img src=\"../icone/ico_info.gif\" width=\"20\" height=\"20\" border=\"0\" align=\"absmiddle\"> = Info&nbsp;\n";
        echo "    </font>\n";
        echo "</td>\n";
        echo "<td align=\"right\" valign=\"middle\" bgcolor=\"white\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        echo "    &nbsp;<img src=\"../icone/ico_protected.gif\" width=\"45\" height=\"15\" border=\"0\" hspace=\"5\" align=\"absmiddle\" alt=\"This links are password protected\" align=\"absmiddle\">&nbsp;Password protected links: \n";
        echo "    </font>\n";
        echo "</td>\n";
        echo "<td align=\"left\" valign=\"middle\" bgcolor=\"#ffc1c1\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        echo "    &nbsp;<img src=\"../icone/ico_draw.gif\"    width=\"20\" height=\"20\" border=\"0\" align=\"absmiddle\"> = Draw&nbsp;\n";
        echo "    &nbsp;<img src=\"../icone/ico_deposit.gif\" width=\"20\" height=\"20\" border=\"0\" align=\"absmiddle\"> = Deposit&nbsp;\n";
        echo "    &nbsp;<img src=\"../icone/ico_history.gif\" width=\"20\" height=\"20\" border=\"0\" align=\"absmiddle\"> = History&nbsp;\n";
        echo "    &nbsp;<img src=\"../icone/ico_edit.gif\"    width=\"20\" height=\"20\" border=\"0\" align=\"absmiddle\"> = Edit&nbsp;\n";
        echo "    &nbsp;<img src=\"../icone/ico_delete.gif\"  width=\"20\" height=\"20\" border=\"0\" align=\"absmiddle\"> = Delete&nbsp;\n";
        echo "    </font>\n";
        echo "</td>\n";
        echo "</tr>\n"; 
        echo "</table>\n";
        echo "</div>\n";

        // stampo il risultato
        $query="SELECT oid,* FROM libri" . $where_clause . $order_clause;
        $result = db_execute($conn,$query);
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

        print '<div align="center">';
        print '<table cellspacing="1" cellpadding="3" border="0" width="90%">';
        print '<tr bgcolor="#336699">';
        print '    <td width="5%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Num.</font></td>';
        print '    <td width="65%"><font face="arial,helvetica,sans-serif" size="2" style="color: white"><a href="books_list.php?from=' . $from . '&to=' . $to . '&order=t&where=' . $where_encoded . '" style="color:white">Book description</a></font></td>';
        print '    <td width="15%" colspan="3"><font face="arial,helvetica,sans-serif" size="2" style="color: white"><a href="books_list.php?from=' . $from . '&to=' . $to . '&order=c&where=' . $where_encoded . '" style="color:white">Collocation</a></font></td>';
        print '    <td width="15%" colspan="2"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Operation</font></td>';
        for ($count=$from; $count<=$to; $count++)        
        {
            $arr=pg_fetch_array ($result,$count);
            if (($count % 2) == 0) {
                print '<tr bgcolor="#e0e0e0">';
            } else {
                print '<tr bgcolor="white">';
            };

            // first column
            print '<td valign="top" width="5%"';
            if ($arr['presente'] == 'f') { 
                print ' bgcolor="#ffc1c1"> ';
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
            print '<td valign="top" width="65%"';
            if ($arr['presente'] == 'f') { 
                print ' background="../icone/back_drown.gif">';
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
            // 3rd column (3 fields)
            print '<td valign="top" width="5%">';
            print '    <font face="arial,helvetica,sans-serif" size="2">' . $arr['collocazione'] . '</font>';
            print '</td>';
            print '<td valign="top" width="5%">';
            print '    <font face="arial,helvetica,sans-serif" size="2">' . $arr['scaffale'] . '</font>';
            print '</td>';
            print '<td valign="top" width="5%">';
            print '    <font face="arial,helvetica,sans-serif" size="2">' . $arr['numero'] . '</font>';
            print '</td>';                        
            // 4th column
            print '<td valign="top" width="5%">';
            print '    <a href="books_info.php?oid=' . $arr['oid'] . '"><img src="../icone/ico_info.gif" width="20" height="20" border="0" alt="View detailed information for this book"></a>';
            print '</td>';
            // 5th column
            print '<td valign="top" bgcolor="#ffc1c1" width="10%">';
            if ($arr['presente'] == 'f') {
                print '    <a href="secure/books_deposit.php?coll=' . $arr['collocazione'] . '&shelf=' . $arr['scaffale'] . '&num=' . $arr['numero'] . '"><img src="../icone/ico_deposit.gif" width="20" height="20" border="0" alt="Deposit book"></a>';
            } else {
                print '    <a href="secure/books_draw.php?coll=' . $arr['collocazione'] . '&shelf=' . $arr['scaffale'] . '&num=' . $arr['numero'] . '"><img src="../icone/ico_draw.gif" width="20" height="20" border="0" alt="Draw this book"></a>';
            }
            print '    <a href="secure/books_history.php?coll=' . $arr['collocazione'] . '&shelf=' . $arr['scaffale'] . '&num=' . $arr['numero'] . '"><img src="../icone/ico_history.gif" width="20" height="20" border="0" alt="View history for this book"></a>';
            print '    <a href="secure/books_modify.php?oid=' . $arr['oid'] . '"><img src="../icone/ico_edit.gif" width="20" height="20" border="0" alt="Modify information for this book"></a>';
            print '    <a href="secure/books_delete.php?oid=' . $arr['oid'] . '"><img src="../icone/ico_delete.gif" width="20" height="20" border="0" alt="Delete this book"></a>';
            print '</td>';
            echo "</tr>\n";
        };
        echo "</table>\n";
    }
    // chiudo la connessione
    db_close($conn);
?>

</font>

</body>
</html>
