<?php if (file_exists('../../default.php')) { include '../../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
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
    &nbsp;Navigate: <a href="../../contents.php" target="contents">Home page</a> : <a href="../articles_index.php" target="contents">Articles</a> : Modify an article
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Modify an article</h2></center>
<?php
    // controllo i parametri
    if (!$oid) { 
        print "You don't have selected nothing";
        exit;
    };
    
    // connessione al database
    if (file_exists('../../procedure/connect_db.php')) { include '../../procedure/connect_db.php'; }

    // leggo gli articoli
    $query="SELECT oid,* from articoli WHERE oid=" . $oid;
    $result = pg_Exec ($conn,$query);
    if ($DEBUG) { print 'Query: <B>' . $query . '</B><BR>'; };
    if (!$result) {
        if ($DEBUG) { print 'File articles_delete error: cannot execute query.\n'; };
        exit;
    };

    $arr=pg_fetch_array ($result, 0);

    // chiudo la connessione
    pg_close ($conn);
?>

<?php print '<form method="post" action="articles_modify_commit.php?oid=' . $oid . '">'; ?>
<ul>
    <li>&nbsp;Please modify article description, then confirm changes:<br>
        <?php
            //print '&nbsp;Unique identification number:<input type="text" name="oid" value="' . $oid . '" size="5" readonly><BR>';
            print '&nbsp;<textarea name="note" rows="6" cols="65">' . $arr["articolo"] . '</textarea><br><br>';
        ?>
    <li>&nbsp;Commit changes ?&nbsp;<input type="submit" value="Modify" align="absmiddle">&nbsp;<input type="Reset" value="reset" align="absmiddle">
</ul>
</form>

</body>
</html>