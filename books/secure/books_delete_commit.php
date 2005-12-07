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
    &nbsp;Navigate: <a href="../../contents.php" target="contents">Home page</a> : <a href="../articles_index.php" target="contents">articles</a> : Delete a book
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Delete a book</h2></center>
<?php
    // controllo i parametri
    if (!$oid) { 
        print "You don't have selected nothing";
        exit;
    };

    // connessione al database
    if (file_exists('../../procedure/connect_db.php')) { include '../../procedure/connect_db.php'; }

    // leggo gli articoli
    $query="DELETE FROM libri WHERE oid=" . $oid;
    $result = pg_exec ($conn,$query);
    if ($debug) { print 'query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($debug) { print 'file articles_delete_commit error: cannot execute query.\n'; };
        exit;
    };

    // chiudo la connessione
    pg_close ($conn);
?>

<ul>
    <li>&nbsp;Book deleted. Now you can:<br>
    <ul>
        <li><?php print '<a href="../books_list.php?oid=' . $oid . '&where=' . urlencode(stripslashes($where)) . '">Select another book to delete</a><br>'; ?>
        <li><?php print '<a href="../books_index.php?oid=' . $oid . '&where=' . urlencode(stripslashes($where)) . '">Return to books menu</a><br>'; ?>
    </ul>    
</ul>

</body>
</html>