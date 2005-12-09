<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<? print_navigation('Create table','Home Page','../contents.php','Administrators section','admin_index.php'); ?>
<? print_title('Create table'); ?>

<?
    // imposto la tabella e controllo i valori inseriti
    echo "<table align=\"center\" width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
    echo "<tr>\n";
    echo "    <td align=\"left\" valign=\"top\" width=\"70%\" bgcolor=\"#e0e0e0\">\n";
    echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
   
    $errori=0;
    if ($f_tablename == '') { 
        echo "<b>Warning:</b> You must insert a table name.<br>\n"; $errori++; 
    }

    // termina con un messaggio se ci sono errori
    if ($errori > 0 ) {
        echo "<img src=\"../icone/ico-warning.png\" width=\"48\" height=\"48\" border=\"0\" alt=\"There are some errors!\">\n";
        echo "     <br>There are <b>" . $errori . "</b> error(s). Please go <a href=\"javascript:history.back(1)\">back</a> and modify insert string.\n";
        echo "    </font>\n";
        echo "    </td>\n";
        echo "</tr>\n";
        echo "</table>\n"; 
        exit;
    }
    
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);
    
    $f_tablename=strtolower($f_tablename);
    // insrt table...
    $query="CREATE TABLE " . $f_tablename . "( id text not null )";
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);
    // .. and options
    $query="INSERT INTO sys_options VALUES('" . $f_tablename . "','" . $f_description . "','" . strtolower($f_icon_select) . "')";
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);    
    
    // chiudo la connessione
    db_close($conn);
    
    echo "    Table created.\n";
    echo "    <form action=\"admin_table_create.php\">\n";
    echo "        <input type=\"submit\" value=\"Create another table\">\n";
    echo "    </form>\n";
    echo "    <form action=\"admin_index.php\">\n";
    echo "        <input type=\"submit\" value=\"Return to Administration section\">\n";
    echo "    </form>\n";
    echo "    </font>\n";
    echo "    </td>\n";
    echo "</tr>\n";
    echo "</table>\n";
?>

</font>

</body>
</html>