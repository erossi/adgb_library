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


<? print_navigation('Deposit a book','Home Page','../../contents.php','Books','../books_index.php'); ?>
<? print_title('Deposit a book'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);
    
    // inserisco nella history
    $query="UPDATE prelevati SET data_in='now' WHERE scaffale='" . $shelf . "' AND numero=" . $num . " AND data_in='Infinity'";
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);

    // modifico il flag nella lista libri
    $query="UPDATE libri SET presente=true WHERE collocazione='" . $coll . "' AND scaffale='" . $shelf . "' AND numero=" . $num;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);
    
    // chiudo la connessione
    db_close($conn);

     // imposto la tabella e controllo i valori inseriti
    echo "<table align=\"center\" width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
    echo "<tr>\n";
    echo "    <td align=\"left\" valign=\"top\" width=\"70%\" bgcolor=\"#e0e0e0\">\n";
    echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
    echo "    Book in collocation <b>" . $coll . "</b>, shelf <b>" . $shelf . "</b>, number <b>" . $num . "</b>.<br>\n";
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