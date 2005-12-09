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
<? print_navigation('Modify an user','Home Page','../../contents.php','Users','../users_index.php'); ?>
<? print_title('Modify  a book'); ?>

<?
    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
   
    $errori=0;
    if ($f_name == '') { print '<b>Warning:</b> You must insert a name.<br>'; $errori++; }
    if ($f_surname == '') { print '<b>Warning:</b> You must insert a surname.<br>'; $errori++; }
    if ($f_id_card == '') { print '<b>Warning:</b> You must insert information for ID card.<br>'; $errori++; }        
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

    // aggiorno il database
    $query="UPDATE utenti SET nome='" . $f_name . "', cognome='" . $f_surname ."'," .
           "titolo='" . $f_title . "', carta_identita='" . $f_id_card . "', comune_carta='" . $f_id_card_city .
           "', telefono='" . $f_phone . "' WHERE oid=" . $oid;
    $result = db_execute($conn,$query);

    // leggo gli articoli
    $query="SELECT * FROM utenti WHERE oid=" . $oid;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);
    // guai se non lo trova...
    $arr=pg_fetch_array($result,0);
    
    // print user information 
    echo "    Complete information for user <b>" . $arr['cognome'] . " " . $arr['nome'] . "</b>:<br><br>\n";
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
    
    print '    <form action="../users_index.php">';
    print '        <input type="submit" value="Go to Users Menu">';
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

</font>

</body>
</html>