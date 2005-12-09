<!-- Library version 0.9, Copyright (C) 2000 TecnoBrain
     Library comes with ABSOLUTELY NO WARRANTY; This is free software,
     and you are welcome to redistribute it under GNU Public Licence Terms.
     Please read the file COPYING shipped with this distribution. -->

<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Books</title>
    <link rel="stylesheet" href="../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">


<? print_navigation('Books info','Home Page','../contents.php','Books','books_index.php'); ?>
<? print_title('Books info'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // stampo il risultato
    $query="SELECT oid,* FROM libri WHERE oid=" . $oid;
    $result = db_execute($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($DEBUG) { print 'file books_info error: cannot execute query.\n'; };
        exit;
    };

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);

    // stampo le informazioni sul libro
    echo "<table align=\"center\" width=\"90%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
    echo "<tr>\n";
    echo "    <td align=\"left\" valign=\"top\" width=\"70%\" bgcolor=\"#e0e0e0\">\n";
    echo "    <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
    echo "    Complete information for book in collocation <b>" . $arr['collocazione'] . "</b>, shelf <b>" . $arr['scaffale'] . "</b>, number <b>" . $arr['numero'] . "</b>:<br><br>\n";
    echo "    <table cellspacing=\"1\" cellpadding=\"3\" border=\"0\">\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Title</font></td>\n";
    echo "        <td>\n";
    echo "            <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
    echo "            " . $arr['titolo'];
    if ($arr['info'] != "") { echo " (" . $arr['info'] . ")\n"; }    
    echo "            </font>\n";
    echo "        </td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Authors</font></td>\n";
    echo "        <td>\n";
    echo "            <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
    if ($arr['aut1'] != "") { echo $arr['aut1'] . "<br>\n"; }
    if ($arr['aut2'] != "") { echo $arr['aut2'] . "<br>\n"; }
    if ($arr['aut3'] != "") { echo $arr['aut3'] . "<br>\n"; }
    if ($arr['aut4'] != "") { echo $arr['aut4'] . "<br>\n"; }
    if ($arr['aut5'] != "") { echo $arr['aut5'] . "<br>\n"; }
    if ($arr['aut6'] != "") { echo $arr['aut6'] . "<br>\n"; }
    if ($arr['aut7'] != "") { echo $arr['aut7'] . "<br>\n"; }
    echo "            </font>\n";
    echo "        </td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Editor</font></td>\n";
    echo "        <td><font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['casa_editoriale'] . "</font></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Inventory code</font></td>\n";
    echo "        <td><font face=\"arial,helvetica,sans-serif\" size=\"2\">" . $arr['codice_inventariale'] . "</font></td>\n";
    echo "    </tr>\n";
    echo "    <tr>\n";
    echo "        <td align=\"right\" valign=\"middle\" bgcolor=\"#336699\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">Is book available?</font></td>\n";
    echo "        <td>\n";
    echo "            <font face=\"arial,helvetica,sans-serif\" size=\"2\">\n";
    if ($arr['presente'] == 't') {
        echo "Book is available.\n";
    } else {
        echo "Book is drawn.\n";
    }
    echo "            </font>\n";
    echo "        </td>\n";
    echo "    </tr>\n";    
    echo "    </table>\n";
    echo "    <br>\n";
    
    print '    <form action="secure/books_history.php">';
    print '        <input type="hidden" name="shelf" value="' . $arr['scaffale'] . '">';
    print '        <input type="hidden" name="num" value="' . $arr['numero'] . '">';    
    print '        <input type="submit" value="View history for this book">';
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
