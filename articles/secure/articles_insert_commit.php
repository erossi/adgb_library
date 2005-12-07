<?php if (file_exists('../../default.php')) { include '../../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
<HEAD>
    <TITLE>Library - Articles</TITLE>
    <LINK REL="STYLESHEET" HREF="../../library.css">
</HEAD>
<BODY TEXT="Black" BGCOLOR="White" LINK="#CC9966" ALINK="#CC9966" VLINK="#CC9966">

<!-- Header -->
<TABLE WIDTH="100%" CELLSPACING="0" CELLPADDING="0" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
    &nbsp;Navigate: <A HREF="../../contents.php" TARGET="contents">Home Page</A> : <A HREF="../articles_index.php" TARGET="contents">Articles</A> : Insert an article
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Insert an article</H2></CENTER>

<?php
    // connessione al database
    if (file_exists('../../procedure/connect_db.php')) { include '../../procedure/connect_db.php'; }

    // leggo gli articoli
    $query="INSERT INTO articoli VALUES ('" . $note ."')";
    $result = pg_Exec ($conn,$query);
    if ($DEBUG) { print 'Query: <B>' . $query . '</B><BR>'; };
    if (!$result) {
        if ($DEBUG) { print 'File articles_insert_commit error: cannot execute query.\n'; };
        exit;
    };

    // chiudo la connessione
    pg_close ($conn);
?>

<UL>
    <LI>&nbsp;Article saved. Now you can:<BR>
    <UL>
        <LI>&nbsp;<A HREF="articles_insert.php">Insert another article.</A>
        <LI>&nbsp;<A HREF="../articles_index.php">Return to articles menu.</A>
    </UL>
</UL>

</BODY>
</HTML>