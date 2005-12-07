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
    &nbsp;Navigate: <A HREF="../../contents.php" TARGET="contents">Home Page</A> : <A HREF="../articles_index.php" TARGET="contents">Articles</A> : Articles list
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Insert an article</H2></CENTER>

<DIV ALIGN="LEFT">
<FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
<FORM METHOD="GET" ACTION="articles_insert_commit.php">
&nbsp;Please enter article description, then press "Insert" button to commit:<BR><BR>
&nbsp;<TEXTAREA NAME="note" ROWS="6" COLS="65"></TEXTAREA><BR><BR>
<CENTER><INPUT TYPE="SUBMIT" VALUE="Insert">&nbsp;<INPUT TYPE="RESET" VALUE="Reset"></CENTER>
</FORM>
</FONT>
</DIV>

</BODY>
</HTML>