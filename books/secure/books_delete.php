<?php if (file_exists('../../default.php')) { include '../../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><?php print $prog_name; ?> - Books</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<!-- header -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left">
    <font face="arial,helvetica,sans-serif" size="2">
    &nbsp;Navigate: <a href="../contents.php" target="contents">Home page</a> : <a href="books_index.php" target="contents">Books</a> : Book delete
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Book delete</h2></center>

<?php
    // connessione al database
    if (file_exists('../../procedure/connect_db.php')) { include '../../procedure/connect_db.php'; }

    // stampo il risultato
    $query="SELECT oid,* FROM libri WHERE oid=" . $oid;
    $result = pg_exec ($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($DEBUG) { print 'file books_info error: cannot execute query.\n'; };
        exit;
    };

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);

    // stampo le informazioni sul libro
    print '<ul>';
    print '<li>You have requested to delete this book:<br><br>';
    print '<table cellspacing="1" cellpadding="2" border="0">';
    print '<tr>';
    print '    <td align="left" valign="middle" bgcolor="black" colspan="2"><font face="arial,helvetica,sans-serif" size="2" color="white"> Info for book in shelf ' . $arr['scaffale'] . ' number ' . $arr['numero'] . '</font></td>';
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
    print '    </font></td>';
    print '</tr>';    
    print '<tr>';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">Editor:</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">' . $arr['casa_editoriale'] . '</font></td>';
    print '</tr>';
    print '<tr bgcolor="#33cc99">';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">Codice inventariale:</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">' . $arr['codice_inventariale'] . '</font></td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">Collocazione:</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">' . $arr['collocazione'] . '</font></td>';
    print '</tr>';
    print '<tr bgcolor="#33cc99">';
    print '    <td align="right" valign="top"><font face="arial,helvetica,sans-serif" size="2">Presente:</font></td>';
    print '    <td align="left"  valign="top"><font face="arial,helvetica,sans-serif" size="2">';
    if ($arr['presente'] == 't') {
        print 'Book is available.';
    } else {
        print 'Book is drawn.';
    }
    print '</font></td>';
    print '</tr>';
    print '</table><br>';
    print '<li>Please confirm:&nbsp;';    
    print '<a href="books_delete_commit.php?oid=' . $oid . '">Yes, delete.</a>&nbsp;&nbsp;&nbsp;';
    print '<a href="javascript:history.back(1)">Oops, cancel operation!</a>';
    print '</form>';
    print '</ul>';
    
    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>