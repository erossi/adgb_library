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
    &nbsp;Navigate: <a href="../../contents.php" target="contents">Home page</a> : <a href="../books_index.php" target="contents">Books</a> : Insert a book
    </font>
    </td>
</tr>
</table>

<!-- title -->
<center><h2>Insert a book</h2></center>

<?php
    // controllo dei valori inseriti
    print '<ul>';
    $errori=0;
    if ($titolo == '') { print '<li>You must insert a title.'; $errori++; }
    $scaffale=strtoupper($scaffale);
    if ($scaffale == '') { print '<li>You must insert shelf.'; $errori++; }
    if (!ereg("[A-Z]{1}",$scaffale)) { print "<li>Shelf can be a character from A to Z."; $errori++; }
    if ($numero == '') { print "<li>Number on the shelf missing."; $errori++; }
    if (!ereg("[0-9]{1,3}",$numero)) { print "<li>Number on the shekf invalid."; $errori++; }

    // connessione al database
    if (file_exists('../../procedure/connect_db.php')) { include '../../procedure/connect_db.php'; }

    // controllo se esiste già la coppia shelf/number
    $query="SELECT count(*) FROM libri WHERE scaffale='" . $scaffale . "' AND numero=" . $numero ;
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = pg_exec ($conn,$query);
    // count ritorna sempre una riga
    $arr=pg_fetch_array($result,0);
    if ($DEBUG) { print 'Array 0 is: ' . $arr[0]; }
    if ($arr[0] > 0) {
        print '<li>There is already a book in shelf ' . $scaffale . ' number ' . $numero;
        $errori++;
    }
    if ($errori > 0 ) {
        print '<br><br>There are ' . $errori . ' error(s). Please go <a href="javascript:history.back(1)">back</a> and modify insert string.';
        exit;
    }
    print '</ul>';
    
    // leggo gli articoli
    $query="INSERT INTO libri(scaffale,numero,titolo,info,aut1,aut2,aut3,aut4,aut5,aut6,aut7," .
           "casa_editoriale,codice_inventariale,collocazione,presente) VALUES ('" .
           $scaffale . "'," . $numero . ",'" . $titolo . "','" . $info . "','" . $aut1 . "','" . $aut2 . "','" .
           $aut3 . "','" . $aut4 . "','" . $aut5 . "','" . $aut6 . "','" . $aut7 . "','" . $editore . "','" .
           $codice_inventariale . "','" . $collocazione . "'," . "true)";
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    $result = pg_exec ($conn,$query);

    if (!$result) {
        if ($DEBUG) { print 'file articles_insert_commit error: cannot execute query.\n'; };
        exit;
    };

    // chiudo la connessione
    pg_close ($conn);
?>

<ul>
    <li>&nbsp;Book saved. Now you can:<br>
    <ul>
        <li>&nbsp;<a href="books_insert.php">Insert another book.</a>
        <li>&nbsp;<a href="../books_index.php">Return to books menu.</a>
    </ul>
</ul>

</body>
</html>