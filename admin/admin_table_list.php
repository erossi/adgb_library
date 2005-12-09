<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<? print_navigation('List tables','Home Page','../contents.php','Administrators section','admin_index.php'); ?>
<? print_title('List tables'); ?>

<?
    // no groups (for now!!)
    $where_clause="";
    // no order (for now!!)
    if ($f_order) { $order=$f_order; }
    switch ($order) {
        default: $order_clause="";
    }

    // connect to database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // leggo gli articoli
//    $query="SELECT * FROM pg_tables WHERE NOT (tablename ~* 'pg_') AND NOT (tablename ~* 'sys_')";
    $query="SELECT * FROM sys_options";
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };    
    $result = db_execute($conn,$query);
    
    // count total lines.
    $num_rows=pg_numrows($result);
    if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

    if ($num_rows=='0') {
    ?>
        <table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
                <font face="arial,helvetica,sans-serif" size="-1">
                No tables found.
                <form action="admin_table_create.php">
                    <input type="hidden" name="table" value="<? print $table; ?>">
                    <input type="submit" name="submit" align="absmiddle" value="Create a new table">
                </form>
                </font>
            </td>
        </tr>
        </table>
    <?
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
            echo "        <a href=\"admin_table_list.php?from=" . $count . "&to=" . $temp_to . "&order=" . $order . "&where=" . $where_encoded . "\">" . $count . "</a> &nbsp;\n";
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
        echo "    Legenda:\n";
        echo "    </font>\n";
        echo "    </td>\n";
        echo "    <td align=\"left\" valign=\"middle\" bgcolor=\"#e0e0e0\">\n";
        echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
        echo "    &nbsp;<img src=\"../icone/mini-next.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\">";
        echo "    &nbsp;<img src=\"../icone/mini-back.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\">";
        echo "    &nbsp;<img src=\"../icone/mini-up.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\">";
        echo "    &nbsp;<img src=\"../icone/mini-deposit.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\">";
        echo "    &nbsp;<img src=\"../icone/mini-draw.png\" width=\"25\" height=\"25\" border=\"0\" align=\"absmiddle\">";
        echo "    </font>\n";
        echo "    </td>\n";
        echo "</tr>\n"; 
        echo "</table>\n";
        echo "</div>\n";

        // imposto i limiti dei record da stampare (stampo da $from a $to).
        if ($from=='') { $from=0; };
        if ($to=='') { $to=$to+$max_table_rows-1; };
        // you cannot exceed number of row reported by database.
        if ($to>$num_rows) { $to=$num_rows-1; };
        if ($DEBUG) { print 'Index: <b>from=' . $from . ', to=' . $to . '</b>'; };

        // print columns (the first is always row number)
        echo "<div align=\"center\">\n";
        echo "<table width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
        echo "<tr bgcolor=\"#336699\">\n";
        echo "    <td width=\"5%\">\n";
        echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\" style=\"color: white\">\n";
        echo "        Num.\n";
        echo "        </font>\n";
        echo "    </td>\n";
        echo "    <td width=\"75%\">\n";
        echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\" style=\"color: white\">\n";
        echo "        Table name\n";
        echo "        </font>\n";
        echo "    </td>\n";
        echo "    <td width=\"75%\">\n";
        echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\" style=\"color: white\">\n";
        echo "        Description\n";
        echo "        </font>\n";
        echo "    </td>\n";
        echo "    <td width=\"5%\">\n";
        echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\" style=\"color: white\">\n";
        echo "        Icon\n";
        echo "        </font>\n";
        echo "    </td>\n";
        // print operation
        echo "    <td width=\"5%\">\n";
        echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\" style=\"color: white\">\n";
        echo "        Operation\n";
        echo "        </font>\n";
        echo "    </td>\n";
        echo "</tr>\n";
        for ($count=$from; $count<=$to; $count++)        
        {
            $arr=pg_fetch_array ($result,$count);
            if (($count % 2) == 0) {
                echo "<tr bgcolor=\"#e0e0e0\">\n";
            } else {
                echo "<tr bgcolor=\"white\">\n";
            };

            // first column
            echo "<td width=\"5%\">\n";
            echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
            echo "    " . $count . "\n";
            if ($DEBUG) { print '<i>' . $arr['oid'] . '</i>'; }
            echo "    </font>\n";
            echo "</td>\n";
            // second column (description)
            echo "    <td>\n";
            echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
            echo "        " . $arr['tablename'];
            echo "        </font>\n";
            echo "    </td>\n";            
            // second column (description)
            echo "    <td>\n";
            echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
            echo "        Description (TO BE IMPLEMENTED!)";
            echo "        </font>\n";
            echo "    </td>\n";
            // second column (icon)
            echo "    <td>\n";
            echo "        <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
            echo "        Icon (TO BE IMPLEMENTED!)";
            echo "        </font>\n";
            echo "    </td>\n";
            // last column (print operation)
            echo "    <td valign=\"top\" bgcolor=\"#e0e0e0\" width=\"5%\">\n";
            echo "        <a href=\"admin_table_delete.php?table=" . $arr['tablename'] . "\"><img src=\"../icone/mini-delete.png\" width=\"25\" height=\"25\" border=\"0\" alt=\"Delete table\"></a>\n";
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
