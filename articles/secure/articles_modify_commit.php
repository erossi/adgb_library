<?php if (file_exists('../../default.php')) { include '../../default.php'; } ?>

<!doctype html public "-//w3c//dtd html 3.2 final//en">
<html>
<head>
    <title>Library - Articles</title>
    <link rel="stylesheet" href="../../library.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<!-- header -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left">
    <font face="arial,helvetica,sans-serif" size="2">
    &nbsp;navigate: <a href="../../contents.php" target="contents">Home page</a> : <a href="../articles_index.php" target="contents">Articles</a> : Modify an article
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Modify an article</h2></center>
<?php
    // controllo i parametri
    if (!$oid) { 
        print "you don't have selected nothing";
        exit;
    };
    
    // connessione al database
    if (file_exists('../../procedure/connect_db.php')) { include '../../procedure/connect_db.php'; }

    // leggo gli articoli
    $query="UPDATE articoli SET articolo='" . $note . "' WHERE oid=" . $oid;
    $result = pg_exec ($conn,$query);
    if ($debug) { print 'Query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($debug) { print 'file articles_delete_commit error: cannot execute query.\n'; };
        exit;
    };

    // chiudo la connessione
    pg_close ($conn);
?>

<ul>
    <li>&nbsp;Article modified. Now you can:<br>
    <ul>
        <li><?php print '<a href="../articles_index.php">Return to articles menu</a><br>'; ?>
    </ul>    
</ul>

</body>
</html>