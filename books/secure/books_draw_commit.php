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

<? print_top($prog_name); ?>
<? print_navigation('Draw a book','Home Page','../../contents.php','Books','../books_index.php'); ?>
<? print_title('Draw a book'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // inserisco nella history
    $query="SELECT * FROM prelevati WHERE scaffale='" . $shelf . "' AND numero=" . $num . " AND data_in='Infinity'";
    $result = db_execute($conn,$query);
    
    // l'utente probabilmente ha premuto "reload". comunque la nota di prelievo è già stata inserite nella
    // cronologia
    if (pg_numrows($result) > 0) { 
        exit;
    } else {
        // leggo informazioni sull'utente
        $query="SELECT oid,* FROM utenti WHERE oid=" . $oid ;
        $result = db_execute($conn,$query);
        
        // count ritorna sempre una riga
        $arr=pg_fetch_array($result,0);
            
        // inserisce la data corrente nella cronologia
        $query="INSERT INTO prelevati(nome_utente,cognome_utente,scaffale,numero,data_out,data_in) " .
               "VALUES ('" . $arr['nome'] . "','" . $arr['cognome'] . "','" . $shelf . "'," . $num . ",'now','Infinity')";
        if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        $result = db_execute($conn,$query);
        if (!$result) {
            if ($DEBUG) { print 'file articles_insert_commit error: cannot execute query.\n'; };
            exit;
        };
        
        // Writing flag for book
        $query="UPDATE libri SET presente=false WHERE collocazione='" . $coll . "' AND scaffale='" . $shelf . "' AND numero=" . $num;
        if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        $result = db_execute($conn,$query);
    }
    
    // chiudo la connessione
    db_close($conn);

     // imposto la tabella e controllo i valori inseriti
    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
    echo "    User <b>" . $arr['cognome'] . " " . $arr['nome'] . "</b> has draw book in collocation <b>" . $coll . "</b>, shelf <b>" . $shelf . "</b>, number <b>" . $num . "</b>.<br>\n";
    echo "    <form action=\"../books_list.php\">\n";
    echo "        <input type=\"submit\" value=\"Draw another book\">\n";
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