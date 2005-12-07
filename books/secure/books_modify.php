<?php if (file_exists('../../default.php')) { include '../../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><?php print $prog_name; ?> - Books</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

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

    print '<ul>';
    print '<li>Edit values then press "Commit changes":';
    print '<form method="post" action="books_modify_commit.php?oid=' . $oid . '">';
    print '<table cellspacing="2" cellpadding="2" border="0">';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Title</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="titolo" size="30" align="absmiddle" value="' . $arr['titolo'] . '">&nbsp;(&nbsp;<input type="text" name="info" size="15" align="absmiddle" value="' . $arr['info'] . '">&nbsp;)</td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Author nr. 1</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="aut1" size="30" align="absmiddle" value="' . $arr['aut1'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 2</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="aut2" size="30" align="absmiddle" value="' . $arr['aut2'] . '"></td>';
    print '    </tr>';
    print '    <tr>'; 
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 3</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="aut3" size="30" align="absmiddle" value="' . $arr['aut3'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 4</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="aut4" size="30" align="absmiddle" value="' . $arr['aut4'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 5</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="aut5" size="30" align="absmiddle" value="' . $arr['aut5'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 6</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="aut6" size="30" align="absmiddle" value="' . $arr['aut6'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">nr. 7</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="aut7" size="30" align="absmiddle" value="' . $arr['aut7'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Editor</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="editore" size="30" align="absmiddle" value="' . $arr['casa_editoriale'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Inventory code</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="codice_inventariale" size="30" align="absmiddle" value="' . $arr['codice_inventariale'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Collocation</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="collocazione" size="30" align="absmiddle" value="' . $arr['collocazione'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Shelf</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="scaffale" size="30" maxlength="1" align="absmiddle" value="' . $arr['scaffale'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle"><font face="arial,helvetica,sans-serif" size="2">Number</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="numero" size="30" maxlength="3" align="absmiddle" value="' . $arr['numero'] . '"></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td>&nbsp</td>';
    print '        <td><input type="submit" name="submit" value="Commit changes">&nbsp;<input type="reset" name="reset" value="Reset values"></td>';
    print '    </tr>';
    print '    </table><br><br>';
    print '<li><a href="javascript:history.back(1)">Back</a> to the previous screen.';
    print '</ul>';
?>

    </form>
</ul>

</font>

</body>
</html>