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
<? print_navigation('Book history','Home Page','../contents.php','Books','../books_index.php'); ?>
<? print_title('Book history'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // cerco chi ha prelevato il libro
    $query="SELECT * FROM prelevati WHERE scaffale='" . $shelf . "' AND numero=" . $num . " ORDER BY data_in";
    $result = db_execute($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; }
    if (!$result) {
        if ($DEBUG) { print 'file books_info error: cannot execute query.\n'; }
        exit;
    };
    
    // conto il numero di righe
    $num_rows=pg_numrows($result);
    if ($DEBUG) { print 'Numbers of rows in table: <b>' . $num_rows . '</b><br>'; };

    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
    if ($num_rows==0) {
        print 'No history for this book.<br><br>';
        print '<a href="javascript:history.back(1)">Back</a> to the previous screen.';
    } else {
        // stampo le informazioni sul libro
        echo "    Complete information for book in collocation <b>" . $coll . "</b>, shelf <b>" . $shelf . "</b>, number <b>" . $num . "</b>:<br><br>\n";
        echo "    <table width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
        echo "    <tr>\n";
        echo "        <td align=\"left\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Drawn by</font></td>\n";
        echo "        <td align=\"left\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">At date</font></td>\n";
        echo "        <td align=\"left\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Return date</font></td>\n";
        echo "    </tr>\n";
        for ($count=0; $count<$num_rows; $count++)
        {
            $arr=pg_fetch_array ($result, $count);
            print '<tr>';
            print '    <td valign="left"><font face="arial,helvetica,sans-serif" size="2">' . $arr['nome_utente'] . ' ' . $arr['cognome_utente'] . '</font></td>';
            print '    <td valign="left"><font face="arial,helvetica,sans-serif" size="2">' . $arr['data_out'] . '</font></td>';
            print '    <td valign="left"><font face="arial,helvetica,sans-serif" size="2">' . ($arr['data_in']=='infinity' ? '<i>Not Returned</i>': $arr['data_in']) . '</font></td>';
            print '</tr>';
        }
        print '</table><br><br>';
        print '<a href="javascript:history.back(1)">Back</a> to the previous screen.';
    }
    print '    </font>';
    print '    </td>';

    print '    </td>';
    print '    <td align="justify" valign="top" width="30%" bgcolor="#ffffe0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
    print '    <div align="justify">';
    print '    <b>On-line Help</b><br>';
    print '    <br>';
    print '    Work in progress. This page will be ready ASAP.';
    print '    <br>';
    print '    </div>';
    print '    </font>';
    print '    </td>';
    print '</tr>';    
    print '</table>';
    
    // chiudo la connessione
    db_close($conn);
?>

</body>
</html>