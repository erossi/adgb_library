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
<? print_navigation('Delete an user','Home Page','../../contents.php','Users','../users_index.php'); ?>
<? print_title('Delete an user'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // stampo il risultato
    $query="SELECT oid,* FROM utenti WHERE oid=" . $oid;
    $result = db_execute($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($DEBUG) { print 'file books_delete.php error: cannot execute query.\n'; };
        exit;
    };

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);

    // print user information 
    echo "<table align=\"center\" width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
    echo "<tr>\n";
    echo "    <td align=\"left\" valign=\"top\" width=\"70%\" bgcolor=\"#e0e0e0\">\n";
    echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
    echo "    You have requested to delete user <b>" . $arr['cognome'] . " " . $arr['nome'] . "</b>:<br><br>\n";
    echo "    <table cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Name</font></td>\n";
    echo "        <td><font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['nome'] . "</font></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Surname</font></td>\n";
    echo "        <td><font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['cognome'] . "</font></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Title</font></td>\n";
    echo "        <td><font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['titolo'] . "</font></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">ID Card</font></td>\n";
    echo "        <td><font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['carta_identita'] . "</font></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">ID Card (City)</font></td>\n";
    echo "        <td><font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['comune_carta'] . "</font></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Phone number</font></td>\n";
    echo "        <td><font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['telefono'] . "</font></td>\n";
    echo "    </tr>\n";
    echo "    </table>\n";
    echo "    <br>\n";
    
    print '    <form action="users_delete_commit.php">';
    print '        <input type="hidden" name="oid" value="' . $oid . '">';
    print '        <input type="submit" value="Ok ,delete">';
    print '    </form>';
    print '    <form action="../books_index.php">';
    print '        <input type="submit" value="Oops, cancel operation!">';
    print '    </form>';
    print '    <a href="javascript:history.back(1)">Back</a> to previous screen.';
    print '    </font>';
    print '    </td>';

    print '    <td align="justify" valign="top" width="30%" bgcolor="#ffffe0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
    print '    <div align="justify">';
    print '    <b>On-line Help</b><br>';
    print '    <br>';
    print '    Work in progress.<br>';
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