<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

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
        print 'collocation is: ' . $f_collocation . '<br>';        
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
                $where=" info ~* '$f_info'";
            };
        };
        if ($f_auth1) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " aut1 ~* '$f_auth1'";
            } else {
                $where=" aut1 ~* '$f_auth1'";
            };
        };
        if ($f_auth2) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " aut2 ~* '$f_auth2'";
            } else {
                $where=" aut2 ~* '$f_auth2'";
            };
        };
        if ($f_auth3) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " aut3 ~* '$f_auth3'";
            } else {
                $where=" aut3 ~* '$f_auth3'";
            };
        };
        if ($f_editor) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " casa_editoriale ~* '$f_editor'";
            } else {
                $where=" casa_editoriale ~* '$f_editor'";
            };
        };
        if ($f_collocation) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " collocazione ~* '$f_collocation'";
            } else {
                $where=" collocazione ~* '$f_collocation'";
            };
        };
        if ($f_shelf) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " scaffale ~* '$f_shelf'";
            } else {
                $where=" scaffale ~* '$f_shelf'";
            };
        };
        if ($f_number) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " numero = '$f_number'";
            } else {
                $where=" numero = '$f_number'";
            };
        };
    };

    // toglie tutti gli slashes 
    $where=stripslashes($where);
    // codifica la where clause per poterla trasferire via URL
    $where_encoded=urlencode($where);
    // debug
    if ($DEBUG) {
        print "Where clause is: " . $where;
    }
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
        // print index
        echo "<div align=\"center\">\n";
        echo "<table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"90%\">\n";
        echo "<tr bgcolor=\"white\">\n";
        echo "    <td align=\"right\" valign=\"middle\" bgcolor=\"#e0e0e0\" width=\"10%\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        echo "    Index:\n";
        echo "    </font>\n";
        echo "    </td>\n";
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

        // print icon description
        echo "<div align=\"center\">\n";
        echo "<table cellspacing=\"1\" cellpadding=\"3\" border=\"0\" width=\"90%\">\n";        
        echo "<tr>\n";
        echo "    <td align=\"right\" valign=\"middle\" bgcolor=\"white\" width=\"10%\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        echo "    Key:\n";
        echo "    </font>\n";
        echo "    </td>\n";
        echo "    <td align=\"left\" valign=\"middle\" bgcolor=\"#e0e0e0\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        echo "    &nbsp;<img src=\"../icone/mini-help.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\"> = Information";
        echo "    &nbsp;<img src=\"../icone/mini-draw.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\"> = Draw";
        echo "    &nbsp;<img src=\"../icone/mini-deposit.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\"> = Deposit";
        echo "    &nbsp;<img src=\"../icone/mini-history.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\"> = History";
        echo "    &nbsp;<img src=\"../icone/mini-edit.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\"> = Edit";
        echo "    &nbsp;<img src=\"../icone/mini-delete.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\"> = Delete";
        echo "    </font>\n";
        echo "    </td>\n";
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
                echo "<tr bgcolor=\"#e0e0e0\">\n";
            } else {
                echo "<tr bgcolor=\"white\">\n";
            };

            // first column
            echo "<td valign=\"top\" width=\"5%\">\n";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
            echo "    " . $count . "\n";
            if ($DEBUG) {
                echo "    <i>" . $arr['oid'] . "</i>\n";
            }
            if ($arr['presente'] == 'f') {
                echo "    <i>Drawn</i><br>\n";
            }
            echo "    </font>\n";
            echo "</td>\n";

            // second column
            echo "<td valign=\"top\" width=\"5%\"";
            if ($arr['presente'] == 'f') {
                echo " background=\"../icone/back_drown.gif\">\n";
            } else {
                echo ">\n";
            }
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
            echo "    <i>" . $arr['titolo'] . "</i>\n";
            if ($arr['info'] != "") { echo "&nbsp;(" . $arr['info'] . ")\n"; }
            echo "    <br>" . $arr['aut1'];
            if ($arr['aut2'] != "") { echo ",&nbsp;" . $arr['aut2']; }
            if ($arr['aut3'] != "") { echo ",&nbsp;" . $arr['aut3']; }
            if ($arr['aut4'] != "") { echo ",&nbsp;" . $arr['aut4']; }
            if ($arr['aut5'] != "") { echo ",&nbsp;" . $arr['aut5']; }
            if ($arr['aut6'] != "") { echo ",&nbsp;" . $arr['aut6']; }
            if ($arr['aut7'] != "") { echo ",&nbsp;" . $arr['aut7']; }
            print '    <br><u>' . $arr['casa_editoriale'] . '</u>';
            print '    </font>';
            print '</td>';
            // 3rd column (3 fields)
            echo "<td valign=\"top\" width=\"5%\">\n";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['collocazione'] . "</font>\n";
            echo "</td>\n";
            echo "<td valign=\"top\" width=\"5%\">\n";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['scaffale'] . "</font>\n";
            echo "</td>\n";
            echo "<td valign=\"top\" width=\"5%\">\n";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['numero'] . "</font>\n";
            echo "</td>\n";
            // 4th column
            echo "<td valign=\"top\" bgcolor=\"#e0e0e0\" width=\"5%\">\n";
            echo "    <a href=\"books_info.php?oid=" . $arr['oid'] . "\"><img src=\"../icone/mini-help.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"View detailed information for this book\"></a>\n";
            echo "</td>\n";

            // last column (print operation)
            echo "    <td valign=\"top\" bgcolor=\"#e0e0e0\" width=\"5%\">\n";
            if ($arr['presente'] == 'f') {
                echo "        <a href=\"secure/books_deposit.php?coll=" . $arr['collocazione'] . "&shelf=" . $arr['scaffale'] . "&num=" . $arr['numero'] . "\"><img src=\"../icone/mini-deposit.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"Deposit this book\"></a>\n";
            } else {
                echo "        <a href=\"secure/books_draw.php?coll=" . $arr['collocazione'] . "&shelf=" . $arr['scaffale'] . "&num=" . $arr['numero'] . "\"><img src=\"../icone/mini-draw.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"Draw this book\"></a>\n";
            }
            echo "        <a href=\"secure/books_history.php?coll=" . $arr['collocazione'] . "&shelf=" . $arr['scaffale'] . "&num=" . $arr['numero'] . "\"><img src=\"../icone/mini-history.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"View history for this book\"></a>\n";
            echo "        <a href=\"secure/books_modify.php?oid=" . $arr['oid'] . "\"><img src=\"../icone/mini-edit.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"Modify information for this book\"></a>\n";
            echo "        <a href=\"secure/books_delete.php?oid=" . $arr['oid'] . "\"><img src=\"../icone/mini-delete.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"Delete this book\"></a>\n";
            echo "    </td>\n";
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
