<?php if (file_exists('../../default.php')) { include '../../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
    <TITLE><?php print $prog_name; ?> - Articles</TITLE>
    <LINK REL="STYLESHEET" HREF="../../library.css">
</HEAD>
<BODY TEXT="Black" BGCOLOR="White" LINK="#CC9966" ALINK="#CC9966" VLINK="#CC9966">

<!-- Header -->
<TABLE WIDTH="100%" CELLSPACING="0" CELLPADDING="0" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
    &nbsp;Navigate: <A HREF="../../contents.php" TARGET="contents">Home Page</A> : <A HREF="../articles_index.php" TARGET="contents">Articles</A> : Delete an article
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Delete an article</H2></CENTER>
<?php
    // controllo i parametri
    if (!$oid) { 
        print "You don't have selected nothing";
        exit;
    };
    
    // connessione al database
    if (file_exists('../../procedure/connect_db.php')) { include '../../procedure/connect_db.php'; }

    // leggo gli articoli
    $query="SELECT oid,* FROM articoli WHERE oid=" . $oid;
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

<UL>
    <LI>You have requested to delete this article:<BR><BR>
        <I><?php print $arr["articolo"]; ?></I><BR><BR>
    <LI>Do you really want to delete the above article ?
    <UL>
        <LI><?php print '<A HREF="articles_delete_commit.php?oid=' . $oid . '&where=' . urlencode(stripslashes($where)) . '">Yes, delete!</A><BR>'; ?>
        <LI><?php print '<A HREF="../articles_list.php?oid=' . $oid . '&where=' . urlencode(stripslashes($where)) . '">Oops, cancel operation</A><BR>'; ?>
    </UL>
</UL>

</BODY>
</HTML>