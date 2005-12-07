<?php if (file_exists('../../default.php')) { include '../../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Library - Books</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<!-- header -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left">
    <font face="arial,helvetica,sans-serif" size="2">
    &nbsp;Navigate: <a href="../../contents.php" target="contents">Home page</a> : <a href="../books_index.php" target="contents">Books</a> : Modify a book
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Modify a book</h2></center>

<ul>
<?php
    // controllo i parametri
    if (!$oid) { 
        print "<li>You don't have selected nothing";
        print '</ul>';
        exit;
    };

    $errori=0;
    if ($titolo == '') { print '<li>Devi inserire il titolo.'; $errori++; }
    $scaffale=strtoupper($scaffale);
    if ($scaffale == '') { print '<li>Manca lo scaffale.'; $errori++; }
    if (!ereg("[A-Z]{1}",$scaffale)) { print "<li>Lo scaffale puo' essere un solo carattere da A a Z."; $errori++; }
    if ($numero == '') { print "<li>Manca il numero d'ordine sullo scaffale."; $errori++; }
    if (!ereg("[0-9]{1,3}",$numero)) { print "<li>Formato del numero d'ordine non valido."; $errori++; }
    if ($errori > 0 ) {
        print '<br><br>There are ' . $errori . ' errors. Please go <a href="javascript:history.back(1)">back</a> and modify insert string.';
        print '</ul>';
        exit;
    }

    // connessione al database
    if (file_exists('../../procedure/connect_db.php')) { include '../../procedure/connect_db.php'; }

    // aggiorno il database
    $query="UPDATE libri SET scaffale='" . $scaffale . "', numero=" . $numero . ", titolo='" . $titolo . "', info='" . $info ."'," .
           "aut1='" . $aut1 . "', aut2='" . $aut2 . "', aut3='" . $aut3 . "', aut4='" . $aut4 . "', aut5='" . $aut5 . "', aut6='" . $aut6 .
           "', aut7='" . $aut7 . "', casa_editoriale='" . $casa_editoriale . "', codice_inventariale='" . $codice_inventariale .
           "', collocazione='" . $collocazione . "' WHERE oid=" . $oid;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = pg_exec ($conn,$query);

    if (!$result) {
        if ($DEBUG) { print 'file articles_insert_commit error: cannot execute query.\n'; };
        exit;
    };

    // leggo gli articoli
    $query="SELECT * FROM libri WHERE scaffale='" . $scaffale . "' AND numero=" . $numero;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = pg_exec ($conn,$query);
    // guai se non lo trova...
    $arr=pg_fetch_array($result,0);
    
    // stampo le informazioni sul libro
    print '<li>Complete info for modified book:<br><br>';
    print '<table cellspacing="1" cellpadding="2" border="0">';
    print '<tr>';
    print '    <td align="left" valign="middle" bgcolor="black" colspan="2"><font face="arial,helvetica,sans-serif" size="2" color="white">&nbsp;Info for book in shelf ' . $arr['scaffale'] . ' number ' . $arr['numero'] . '</font></td>';
    print '</tr>';    
    print '<tr>';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">Title:</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">';
    print $arr['titolo'];
    if ($arr['info'] != "") { print ' (' . $arr['info'] . ')'; }    
    print '    </font></td>';
    print '</tr>';
    print '<tr bgcolor="#33cc99">';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">Authors:</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">';
    if ($arr['aut1'] != "") { print $arr['aut1'] . '<br>'; }
    if ($arr['aut2'] != "") { print $arr['aut2'] . '<br>'; }
    if ($arr['aut3'] != "") { print $arr['aut3'] . '<br>'; }
    if ($arr['aut4'] != "") { print $arr['aut4'] . '<br>'; }
    if ($arr['aut5'] != "") { print $arr['aut5'] . '<br>'; }
    if ($arr['aut6'] != "") { print $arr['aut6'] . '<br>'; }
    if ($arr['aut7'] != "") { print $arr['aut7'] . '<br>'; }
    print '    &nbsp';
    print '    </font></td>';
    print '</tr>';    
    print '<tr>';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">Editor:</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">' . ($arr['casa_editoriale'] == '' ? '<i>Empty</i>' : $arr['casa_editoriale']) . '</font></td>';
    print '</tr>';
    print '<tr bgcolor="#33cc99">';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">Inventory code:</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">' . ($arr['codice_inventariale'] == '' ? '<i>Empty</i>' : $arr['codice_inventariale']) . '</font></td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">Collocation:</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">' . ($arr['collocazione'] == '' ? '<i>Empty</i>' : $arr['collocazione']) . '</font></td>';
    print '</tr>';
    print '<tr bgcolor="#33cc99">';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">&nbsp;Is book available?</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">';
    if ($arr['presente'] == 't') {
        print 'Book is available.';
    } else {
        print 'Book is drawn.';
    }
    print '</font></td>';
    print '</tr>';
    print '</table><br><br>';

    // chiudo la connessione
    pg_close ($conn);
?>

<li>&nbsp;Book saved. <a href="../books_index.php">Return to books menu.</a>
</ul>


</body>
</html>