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
    &nbsp;Navigate: <a href="../../contents.php" target="contents">Home page</a> : <a href="../books_index.php" target="contents">Books</a> : Book history
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Book history</h2></center>

<?php
    // connessione al database
    if (file_exists('../../procedure/connect_db.php')) { include '../../procedure/connect_db.php'; }

    // cerco chi ha prelevato il libro
    $query="SELECT * FROM prelevati WHERE scaffale='" . $shelf . "' AND numero=" . $num . " ORDER BY data_in";
    $result = pg_exec ($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; }
    if (!$result) {
        if ($DEBUG) { print 'file books_info error: cannot execute query.\n'; }
        exit;
    };
    
    // conto il numero di righe
    $num_rows=pg_numrows($result);
    if ($DEBUG) { print 'Numbers of rows in table: <b>' . $num_rows . '</b><br>'; };

    if ($num_rows==0) {
        print '<ul>';
        print '    <li>No history for this book.<br><br>';
        print '    <li><a href="javascript:history.back(1)">Back</a> to the previous screen.';
        print '</ul>';        
        print '</ul>';
    } else {
        // stampo le informazioni sul libro
        print '<ul>';
        print '<li>Complete history for book:<br><br>';
        print '<table cellspacing="1" cellpadding="2" border="0">';
        print '<tr>';
        print '    <td align="left" valign="middle" bgcolor="black" colspan="3"><font face="arial,helvetica,sans-serif" size="2" color="white"> History for book in shelf ' . $shelf . ' number ' . $num . '</font></td>';
        print '</tr>';
        print '<tr bgcolor="black">';
        print '    <td valign="middle"><font face="arial,helvetica,sans-serif" size="2"><font face="arial,helvetica,sans-serif" size="2" color="white"> Drawn by</font></td>';
        print '    <td valign="middle"><font face="arial,helvetica,sans-serif" size="2"><font face="arial,helvetica,sans-serif" size="2" color="white"> At date</font></td>';
        print '    <td valign="middle"><font face="arial,helvetica,sans-serif" size="2"><font face="arial,helvetica,sans-serif" size="2" color="white"> Return date</font></td>';
        print '</tr>';
        for ($count=$from; $count<=$to; $count++)
        {
            $arr=pg_fetch_array ($result, $count);
            if (($count % 2) == 0) {
                print '<tr bgcolor="#33cc99">';
            } else {
                print '<tr bgcolor="white">';
            };
            print '<tr>';
            print '    <td valign="middle"><font face="arial,helvetica,sans-serif" size="2">' . $arr['nome_utente'] . ' ' . $arr['cognome_utente'] . '</font></td>';
            print '    <td valign="middle"><font face="arial,helvetica,sans-serif" size="2">' . $arr['data_out'] . '</font></td>';
            print '    <td valign="middle"><font face="arial,helvetica,sans-serif" size="2">' . $arr['data_in'] . '</font></td>';
            print '</tr>';
        }
        print '</table><br><br>';
        print '<li><a href="javascript:history.back(1)">Back</a> to the previous screen.';
        print '</ul>';
    }
    
    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>