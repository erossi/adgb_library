<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Users</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Users list','Home Page','../../contents.php','Users','../users_index.php'); ?>
<? print_title('Users list'); ?>

<?
    // controllo i parametri
    if ($DEBUG) { 
        print 'name is: ' . $f_name . '<br>';
        print 'surname is: ' . $f_surname . '<br>';
        print 'id_card is: ' . $f_id_card . '<br>';
        print 'logical op is: ' . $f_logical_op . '<br>';
    };
    // string control: crea la where clause
    if (!$where) {
        if ($f_name) { $where="nome ~* '$f_name'"; };
        if ($f_surname) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " cognome ~* '$f_surname'";
            } else {
                $where="cognome ~* '$f_surname'";
            };
        };
        if ($f_id_card) {
            if ($where) {
                $where=$where . " " . $f_logical_op . " carta_identita ~* '$f_id_card'";
            } else {
                $where="carta_identita ~* '$f_id_card'";
            };
        };
    };
    
    // toglie tutti gli slashes 
    $where=stripslashes($where);
    // codifica la where clause per poterla trasferire via URL
    $where_encoded=urlencode($where);
   // if there is something we add "where " at the where clause
    if ($where) { $where_clause=" WHERE " . $where; };
    // order by...
    if ($f_order) { $order=$f_order; }
    switch ($order) {
        case "s": $order_clause=" ORDER BY cognome"; break;
        case "i": $order_clause=" ORDER BY carta_identita"; break;
        default: $order_clause="";
    }
    
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);    

    // leggo gli articoli
    $query="SELECT count(*) FROM utenti" . $where_clause;
    $result=db_execute($conn,$query);
    
    // conto il numero di linee trovate (count ritorna sempre qualcosa).
    $arr=pg_fetch_array ($result,0);
    $num_rows=$arr[0];
    if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

    if ($num_rows=='0') {
        print '<ul>';
        print '    <li>No users found.';
        print '</ul>';
    } else {
        // stampo l'indice
        print '<div align="center">';
        print '<table cellspacing="1" cellpadding="3" border="0" width="90%">';
        print '<tr bgcolor="white">';
        print '    <td  width="5%"><font face="arial,helvetica,sans-serif" size="2">Index:</font></td>';
        print '    <td width="95%"><font face="arial,helvetica,sans-serif" size="2">&nbsp;';
        for ($count=0; $count<$num_rows; $count+=$max_table_rows) {
            $temp_to=$count+$max_table_rows-1;
            if ($temp_to>$num_rows) { $temp_to=$num_rows-1; };
            print '<a href="users_list.php?from=' . $count . '&to=' . $temp_to . '&where=' . $where_encoded . '">' . $count . '</a> &nbsp;';
        }
        print ': Total ' . $num_rows;
        print '</font></td></tr></table>';
        print '</div>';
        
        // legenda
        print '<div align="center">';
        print '<table cellspacing="1" cellpadding="3" border="0" width="90%">';        
        print '<tr>';
        print '<td align="right" valign="middle" bgcolor="white">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
        print '    &nbsp;<img src="../../icone/ico_protected.gif" width="45" height="15" border="0" hspace="5" align="absmiddle" alt="This links are password protected" align="absmiddle">&nbsp;Password protected links: ';
        print '    </font>';
        print '</td>';
        print '<td align="left" valign="middle" bgcolor="#ffc1c1">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
        print '    &nbsp;<img src="../../icone/ico_edit.gif" width="20" height="20" border="0" align="absmiddle"> = Edit&nbsp;';
        print '    &nbsp;<img src="../../icone/ico_delete.gif" width="20" height="20" border="0" align="absmiddle"> = Delete&nbsp;';
        print '    </font>';
        print '</td>';
        print '</tr>'; 
        print '</table>';
        print '</div>';

        // stampo il risultato
        $query="SELECT oid,* FROM utenti" . $where_clause  . $order_clause;
        $result=db_execute($conn,$query);
        if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        if (!$result) {
            if ($DEBUG) { print 'file users_list error: cannot execute query.\n'; };
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
        print '    <td width="85%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">User description</font></td>';
        print '    <td width="10%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Operation</font></td>';
        print '</tr>';
        for ($count=$from; $count<=$to; $count++)        
        {
            $arr=pg_fetch_array ($result,$count);
            if (($count % 2) == 0) {
                print '<tr bgcolor="#e0e0e0">';
            } else {
                print '<tr bgcolor="white">';
            };

            // first column
            print '<td valign="top">';
            print '    <font face="arial,helvetica,sans-serif" size="2">';
            print $count . '<br>';
            if ($DEBUG) { print '<i>' . $arr['oid'] . '</i>'; }
            print '    </font>';
            print '</td>';

            // second column
            echo "<td valign=\"top\">\n";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
            
            echo "    <i>" . $arr['nome'] . "&nbsp;" . $arr['cognome'];
            if ($arr['titolo']) {
                echo " (" . $arr['titolo'] . ")<br>\n";
            } else {
                echo "<br>\n";
            }
            echo "    Identity card: " . $arr['carta_identita'] . " (" . $arr['comune_carta'] . ")<br>\n";
            echo "    Tel: " . $arr['telefono'] . "<br>\n";
            echo "    </font>\n";
            echo "</td>\n";
            
            // third column
            print '<td valign="top" bgcolor="#ffc1c1">';
            print '    <a href="users_modify.php?oid=' . $arr['oid'] . '"><img src="../../icone/ico_edit.gif" width="20" height="20" border="0" alt="Modify information for this user"></a>';
            print '    <a href="users_delete.php?oid=' . $arr['oid'] . '"><img src="../../icone/ico_delete.gif" width="20" height="20" border="0" alt="Delete this user"></a>';
            print '</td>';
            print '</tr>';
        };
        print '</table>';
    }
    // chiudo la connessione
    db_close($conn);
?>

</body>
</html>
