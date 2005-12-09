<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<? print_navigation('Check drawn books','Home Page','../../contents.php','Books','../books_index.php'); ?>
<? print_title('Check drawn books'); ?>

<?
    // controllo i parametri
    $query="SELECT count(*) FROM prelevati AS a,libri AS l WHERE a.scaffale=l.scaffale AND a.numero=l.numero AND data_in='Infinity'";

    // where..
    // NON C'E' MA E' STATA LASCIATA IN PREVISIONE DI MODIFCHE
    $where_clause="";

    // order by...
    if ($f_order) { $order=$f_order; }
    switch ($order) {
        case "t": $order_clause=" ORDER BY titolo"; break;
        case "c": $order_clause=" ORDER BY l.collocazione,l.scaffale,l.numero"; break;
        default: $order_clause="";
    }

    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);    

    // leggo gli articoli
    $query=$query . $where_clause;
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
            echo "        <a href=\"books_check_drawn.php?from=" . $count . "&to=" . $temp_to . "&order=" . $order . "&where=" . $where_encoded . "\">" . $count . "</a> &nbsp;\n";
        }
        echo ": Total " . $num_rows . "\n";
        echo "    </font></td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo "</div>\n";

        // print icon description
/*        echo "<div align=\"center\">\n";
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
        echo "</div>\n";*/
        
        // stampo il risultato
        $query="SELECT nome_utente,cognome_utente,collocazione,l.scaffale,l.numero,data_out,titolo,info,aut1,aut2,casa_editoriale FROM prelevati AS a,libri AS l WHERE a.scaffale=l.scaffale AND a.numero=l.numero AND data_in='Infinity'" . $where_clause . $order_clause;
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
        print '    <td width="50%"><font face="arial,helvetica,sans-serif" size="2" style="color: white"><a href="books_check_drawn.php?from=' . $from . '&to=' . $to . '&order=t&where=' . $where_encoded . '" style="color:white">Book description</a></font></td>';
        print '    <td width="15%"><font face="arial,helvetica,sans-serif" size="2" style="color: white"><a href="books_check_drawn.php?from=' . $from . '&to=' . $to . '&order=c&where=' . $where_encoded . '" style="color:white">Collocation</a></font></td>';
        print '    <td width="30%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">User Information</font></td>';
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
            echo "<td valign=\"top\" width=\"50%\">";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
            echo "    <i>" . $arr['titolo'] . "</i>\n";
            if ($arr['info'] != "") { echo "&nbsp;(" . $arr['info'] . ")\n"; }
            echo "    <br>" . $arr['aut1'];
            if ($arr['aut2'] != "") { echo ",&nbsp;" . $arr['aut2']; }
            print '    <br><u>' . $arr['casa_editoriale'] . '</u>';
            print '    </font>';
            print '</td>';
            // 3rd column
            echo "<td valign=\"top\" width=\"15%\">\n";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['collocazione'] . "/" . $arr['scaffale'] . "/" . $arr['numero'] . "</font>\n";
            echo "</td>\n";
            // 4th column
            echo "<td valign=\"top\" bgcolor=\"#e0e0e0\" width=\"5%\">\n";
            echo "    " . $arr['nome_utente'] . "<br>" . $arr['cognome_utente'] . "<br>" . $arr['data_out'] .  "\n";
            echo "</td>\n";

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
