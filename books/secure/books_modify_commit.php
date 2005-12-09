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


<? print_navigation('Modify a book','Home Page','../../contents.php','Books','../books_index.php'); ?>
<? print_title('Modify  a book'); ?>

<?
    // controllo i parametri
    if (!$oid) { 
        print "<li>You don't have selected nothing";
        print '</ul>';
        exit;
    };

    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
   
    $errori=0;
    if ($f_title == "") { print '<b>Warning:</b> You must insert a title.<br>'; $errori++; }
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
    $query="UPDATE libri SET titolo='" . $f_title . "', info='" . $f_info ."'," .
           "aut1='" . $f_auth1 . "', aut2='" . $f_auth2 . "', aut3='" . $f_auth3 . "', aut4='" . $f_auth4 . "', aut5='" . $f_auth5 . "', aut6='" . $f_auth6 . "', aut7='" . $f_auth7 .
           "', casa_editoriale='" . $f_editor . "', codice_inventariale='" . $f_inventory . "' WHERE oid=" . $oid;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);
    if (!$result) {
        if ($DEBUG) { print 'file book_modify_commit error: cannot execute query.\n'; };
        exit;
    };

    // leggo gli articoli
    $query="SELECT * FROM libri WHERE collocazione='" . $f_collocation . "' AND scaffale='" . $f_shelf . "' AND numero=" . $f_number ;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);
    // guai se non lo trova...
    $arr=pg_fetch_array($result,0);
    
    // stampo le informazioni sul libro
    print '    Complete information for book in collocation <b>' . $arr['collocazione'] . '</b>, shelf <b>' . $arr['scaffale'] . '</b>, number <b>' . $arr['numero'] . '</b>:<br><br>';
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
    print '    <br>';
    
    print '    <form action="../books_index.php">';
    print '        <input type="hidden" name="shelf" value="' . $arr['scaffale'] . '">';
    print '        <input type="hidden" name="num" value="' . $arr['numero'] . '">';    
    print '        <input type="submit" value="Go to Books Menu">';
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