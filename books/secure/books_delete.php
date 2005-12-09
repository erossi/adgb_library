<!-- Library version 0.9, Copyright (C) 2000 TecnoBrain
     Library comes with ABSOLUTELY NO WARRANTY; This is free software,
     and you are welcome to redistribute it under GNU Public Licence Terms.
     Please read the file COPYING shipped with this distribution. -->

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


<? print_navigation('Delete a book','Home Page','../../contents.php','Books','../books_index.php'); ?>
<? print_title('Delete a book'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // stampo il risultato
    $query="SELECT oid,* FROM libri WHERE oid=" . $oid;
    $result = db_execute($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($DEBUG) { print 'file books_delete.php error: cannot execute query.\n'; };
        exit;
    };

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);

    // stampo le informazioni sul libro
    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
    print '    You have requested to delete book in collocation <b>' . $arr['collocazione'] . '</b> shelf <b>' . $arr['scaffale'] . '</b> number <b>' . $arr['numero'] . '</b>:<br><br>';
    print '    <table cellspacing="1" cellpadding="3" border="0">';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Title</font></td>';
    print '        <td>';
    print '            <font face="arial,helvetica,sans-serif" size="2">';
    print $arr['titolo'];
    if ($arr['info'] != "") { print ' (' . $arr['info'] . ')'; }    
    print '            </font>';
    print '        </td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Authors</font></td>';
    print '        <td>';
    print '            <font face="arial,helvetica,sans-serif" size="2">';
    if ($arr['aut1'] != "") { print $arr['aut1'] . '<br>'; }
    if ($arr['aut2'] != "") { print $arr['aut2'] . '<br>'; }
    if ($arr['aut3'] != "") { print $arr['aut3'] . '<br>'; }
    if ($arr['aut4'] != "") { print $arr['aut4'] . '<br>'; }
    if ($arr['aut5'] != "") { print $arr['aut5'] . '<br>'; }
    if ($arr['aut6'] != "") { print $arr['aut6'] . '<br>'; }
    if ($arr['aut7'] != "") { print $arr['aut7'] . '<br>'; }
    print '            </font>';
    print '        </td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Editor</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['casa_editoriale'] . '</font></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Inventory code</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['codice_inventariale'] . '</font></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Collocation</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['collocazione'] . '</font></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Is book available?</font></td>';
    print '        <td>';
    print '            <font face="arial,helvetica,sans-serif" size="2">';
    if ($arr['presente'] == 't') {
        print 'Book is available.';
    } else {
        print 'Book is drawn.';
    }
    print '            </font>';
    print '        </td>';
    print '    </tr>';    
    print '    </table>';
    print '<form action="books_delete_commit.php">';
    print '    <input type="hidden" name="oid" value="' . $oid . '">';
    print '    <input type="submit" value="Ok ,delete">';
    print '</form>';
    print '<form action="../books_index.php">';
    print '    <input type="submit" value="Oops, cancel operation!">';
    print '</form>';
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
