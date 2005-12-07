<?php if (file_exists('../../default.php')) { include '../../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
    <TITLE>Library - Preference</TITLE>
    <LINK REL="STYLESHEET" HREF="../library.css">
</HEAD>
<BODY TEXT="Black" BGCOLOR="White" LINK="#CC9966" ALINK="#CC9966" VLINK="#CC9966">

<!-- Header -->
<TABLE WIDTH="100%" CELLSPACING="0" CELLPADDING="0" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
    &nbsp;Navigate: <A HREF="../../contents.php" TARGET="contents">Home Page</A> : <A HREF="preference_index.php" TARGET="contents">Preference</A> : Administrators list
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Administrators List</H2></CENTER>

<?php
    // connessione al database
    if (file_exists('../procedure/connect_db.php')) { include '../procedure/connect_db.php'; }
    
    // stampo il risultato
    $query="SELECT * FROM password";
    $result = pg_Exec ($conn,$query);
    if ($DEBUG) { print 'Query: <B>' . $query . '</B><BR>'; };
    if (!$result) {
        if ($DEBUG) { print 'File users_admin error: cannot execute query.\n'; };
        exit;
    };
   
    // conto il numero di righe
    $num_rows=pg_numrows($result);
    if ($DEBUG) { print 'Numbers of rows in table: <B>' . $num_rows . '</B><BR>'; };
    
    print '<TABLE CELLSPACING="1" CELLPADDING="2" BORDER="0" WIDTH="100%">';
    print '<TR BGCOLOR="Black">';
    print '<TD WIDTH="5%"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Num.</FONT></TD>';
    print '<TD><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Username</FONT></TD>';
    print '<TD><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Password</FONT></TD>';
    print '<TD><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Area</FONT></TD>';
    for ($count=0; $count<$num_rows; $count++)
    {
        $arr=pg_fetch_array ($result, $count);
        if (($count % 2) == 0) {
            print '<TR BGCOLOR="#33CC99">';
        } else {
            print '<TR BGCOLOR="White">';
        };
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $count . '</FONT></TD>';
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $arr['username'] . '</FONT></TD>';
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $arr['password'] . '</FONT></TD>';
        print '<TD VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">' . $arr['area'] . '</FONT></TD>';
        print '</TR>';
    };
    print '</TABLE>';

    // chiudo la connessione
    pg_close ($conn);
?>

</BODY>
</HTML>