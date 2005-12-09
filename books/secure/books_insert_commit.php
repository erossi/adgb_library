<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Books</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">


<? print_navigation('Insert a new book','Home Page','../../contents.php','Books','../books_index.php'); ?>
<? print_title('Insert a new book'); ?>

<?
    // imposto la tabella e controllo i valori inseriti
    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
   
    $errori=0;
    if ($f_title == "") { print '<b>Warning:</b> You must insert a title.<br>'; $errori++; }
    $f_collocation=strtoupper($f_collocation);
    if ($f_collocation == "") {
        print '<b>Warning:</b> You must insert collocation.<br>'; $errori++;
    } else {
        if (!ereg("[A-Z]{1}",$f_collocation)) { print '<b>Warning:</b> Collocation can be a character from A to Z.<br>'; $errori++; }
    }
    $f_shelf=strtoupper($f_shelf);
    if ($f_shelf == "") {
        print '<b>Warning:</b> You must insert shelf.<br>'; $errori++;
    } else {
        if (!ereg("[A-Z]{1}",$f_shelf)) { print '<b>Warning:</b> Shelf can be a character from A to Z.<br>'; $errori++; }
    }
    if ($f_number == "") {
        print '<b>Warning:</b> Number on the shelf missing.<br>'; $errori++;
    } else {
        if (!ereg("[0-9]{1,3}",$f_number)) { print '<b>Warning:</b> Number on the shelf invalid.<br>'; $errori++; }
    }
    // termina con un messaggio se ci sono errori
    if ($errori > 0 ) {
        print '     <br>There are <b>' . $errori . '</b> error(s). Please go <a href="javascript:history.back(1)">back</a> and modify insert string.';
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>'; 
        exit;
    }
    
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);
    
    // controllo se esiste già la coppia shelf/number
    $query="SELECT count(*) FROM libri WHERE collocazione='" . $f_collocation . "' AND scaffale='" . $f_shelf . "' AND numero=" . $f_number ;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    
    $result = db_execute($conn,$query);
    // count ritorna sempre una riga
    $arr=pg_fetch_array($result,0);
    if ($DEBUG) { print 'Array 0 is: ' . $arr[0]; }
    if ($arr[0] > 0) {
        print '     <b>Warning:</b> There is already a book in collocation <b>' . $f_collocation . '</b>, shelf <b>' . $f_shelf . '</b>, number <b>' . $f_number . '</b>.<br>';
        $errori++;
    }
    if ($errori > 0 ) {
        print '     <br>There are <b>' . $errori . '</b> error(s). Please go <a href="javascript:history.back(1)">back</a> and modify insert string.';
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>'; 
        exit;
    }
//    print '</ul>';
    
    // leggo gli articoli
    $query="INSERT INTO libri(scaffale,numero,titolo,info,aut1,aut2,aut3,aut4,aut5,aut6,aut7," .
           "casa_editoriale,codice_inventariale,collocazione,presente) VALUES ('" .
           $f_shelf . "'," . $f_number . ",'" . $f_title . "','" . $f_info . "','" . $f_auth1 . "','" . $f_auth2 . "','" .
           $f_auth3 . "','" . $f_auth4 . "','" . $f_auth5 . "','" . $f_auth6 . "','" . $f_auth7 . "','" . $f_editor . "','" .
           $f_inventory . "','" . $f_collocation . "'," . "true)";
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);

    if (!$result) {
        if ($DEBUG) { print 'file articles_insert_commit error: cannot execute query.\n'; };
        exit;
    };

    // chiudo la connessione
    db_close($conn);
    
    echo "    Book saved.\n";
    echo "    <form action=\"books_insert.php\">\n";
    echo "        <input type=\"submit\" value=\"Insert another book\">\n";
    echo "    </form>\n";
    echo "    <form action=\"../books_index.php\">\n";
    echo "        <input type=\"submit\" value=\"Return to Books menu\">\n";
    echo "    </form>\n";
    echo "    </font>\n";
    echo "    </td>\n";
    echo "</tr>\n";
    echo "</table>\n";

?>


</font>

</body>
</html>