<?php
    $mystring = 'xaabc';
    $findme   = 'w';
    $pos = strpos($mystring, $findme);

    // Note our use of ===.  Simply == would not work as expected
    // because the position of 'a' was the 0th (first) character.
    if ($pos === false) {
       echo "The string '$findme' was not found in the string '$mystring'";
    } else {
       echo "The string '$findme' was found in the string '$mystring'";
       echo " and exists at position $pos";
    }
?>

<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<? print_navigation('Articles list','Home Page','../contents.php','Articles','articles_index.php'); ?>
<? print_title('Articles list'); ?>

<?
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

    // toglie tutti gli slashes 
    $where=stripslashes($where);
    // codifica la where clause per poterla trasferire via URL
    $where_encoded=urlencode($where);
    // if there is something we add "where " at the where clause
    if ($where) { $where_clause=" WHERE " . $where; }

    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);    

    // leggo gli articoli
    $query="SELECT count(*) FROM articoli" . $where_clause;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };    
    $result = db_execute($conn,$query);
    
    // conto il numero di linee trovate (count ritorna sempre qualcosa).
    $arr=pg_fetch_array ($result,0);
    $num_rows=$arr[0];
    if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

    if ($num_rows=='0') {
        echo "<ul>\n";
        echo "  <li>No articles found.\n";
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
            echo "        <a href=\"articles_list.php?from=" . $count . "&to=" . $temp_to . "&order=" . $order . "&where=" . $where_encoded . "\">" . $count . "</a> &nbsp;\n";
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
        echo "    &nbsp;<img src=\"../img/mini-edit.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\"> = Edit";
        echo "    &nbsp;<img src=\"../img/mini-delete.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\"> = Delete";
        echo "    </font>\n";
        echo "    </td>\n";
        echo "</tr>\n"; 
        echo "</table>\n";
        echo "</div>\n";
    
        // stampo il risultato
        $query="SELECT oid,* FROM articoli" . $where_clause;
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
        print '    <td width="90%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Article description</font></td>';
        print '    <td width="5%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Operation</font></td>';
        for ($count=$from; $count<=$to; $count++)        
        {
            $arr=pg_fetch_array ($result,$count);
            if (($count % 2) == 0) {
                echo "<tr bgcolor=\"#e0e0e0\">\n";
            } else {
                echo "<tr bgcolor=\"white\">\n";
            };

            // 1st column
            echo "<td valign=\"top\" width=\"5%\">\n";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
            echo "    " . $count . "<br>\n";
            if ($DEBUG) { print '<i>' . $arr['oid'] . '</i>'; }
            echo "    </font>\n";
            echo "</td>\n";
            // 2nd column
            echo "<td valign=\"top\" width=\"90%\">\n";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">";
          
            // evidenzio le occorrenze trovate
            // offset=0 vuol dire che parto dall'inizio
            $offset=0;           // posizione della prima stringa

            // metto in lowercase le stringhe da cercare una volta per tutte
            // così aumento la velocità
            $searchstring  = strtolower($arr['articolo']);
            $neddle1 = strtolower($string1);
            $neddle2 = strtolower($string2);
            $neddle3 = strtolower($string3);
            do {
                if ($DEBUG) {
                    echo "<i>" . $arr['articolo'] . "</i><br>\n";
                }
                
                // indica se ho trovato una stringa di ricerca
                // notare l'uso di ===. l'uguale semplice == non funzionerebbe perchè
                // è il primo carattere.
                $found_string=false;

                if ($string3) {
                    $pos1 = strpos($searchstring, $neddle1);
                    if ($pos1 === false) {
                        if ($DEBUG) { echo '$pos1 not found.<br>'; }
                        $pos1=0;
                    } else {
                        $found_string=true;
                        if ($DEBUG) { echo '$pos1 found at position <b>' . $pos1 . '</b>.<br>'; }
                    };
                } else {
                    $pos1=0;
                }


                if ($string2) {
                    $pos2 = strpos($searchstring, $neddle2);
                    if ($pos2 === false) {
                        if ($DEBUG) { echo '$pos2 not found.<br>'; }
                        $pos2=0;
                    } else {
                        $found_string=true;
                        if ($DEBUG) { echo '$pos2 found at position <b>' . $pos2 . '</b>.<br>'; }

                    };
                } else {
                    $pos2=0;
                }

                if ($string3) {
                    $pos3 = strpos($searchstring, $neddle3);
                    if ($pos3 === false) {
                        if ($DEBUG) { echo '$pos3 not found.<br>'; }
                        $pos3=0;
                    } else {
                        $found_string=true;
                        if ($DEBUG) { echo '$pos3 found at position <b>' . $pos3 . '</b>.<br>'; }
                    }
                } else {
                    $pos3=0;
                }

                
                if ($DEBUG) { 
                    echo '$found_string value: <b>' . $found_string . '</b>.<br>';
                }

                //
                if ($found_string) {
                    $next_offset=min($pos1,$pos2,$pos3);
                    if ($next_offset===$pos1) {
                        $step=strlen($neddle1);
                    }
                    if ($next_offset===$pos2) {
                        $step=strlen($neddle2);
                    }
                    if ($next_offset===$pos3) {
                        $step=strlen($neddle3);
                    }
                    
                    if ($DEBUG) { 
                        echo '$step = <b>' . $step . '</b>.<br>';
                        echo '$next_offset = <b>' . $next_offset . '</b>.<br>';
                    }
                    // 
                    echo substr($arr['articolo'], $offset, $next_offset);
                    echo "<b>";
                    echo substr($arr['articolo'], $next_offset, $next_offset+$step);
                    echo "</b>";
                    $offset=$next_offset+1;
                }
            } while ($found);
            
            echo substr($arr['articolo'], $offset+$step);
            
            echo "</font>\n";
            echo "</td>\n";
            
            // 3rd column
            echo "    <td valign=\"top\" bgcolor=\"#e0e0e0\" width=\"5%\">\n";
            echo "        <a href=\"secure/articles_modify.php?oid=" . $arr['oid'] . "\"><img src=\"../img/mini-edit.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"Modify information for this article\"></a>\n";
            echo "        <a href=\"secure/articles_delete.php?oid=" . $arr['oid'] . "\"><img src=\"../img/mini-delete.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"Delete this article\"></a>\n";
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