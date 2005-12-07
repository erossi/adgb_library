<?php if (file_exists('default.php')) { include 'default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
<HEAD>
    <TITLE><?php print $prog_name; ?></TITLE>
    <LINK REL="STYLESHEET" HREF="library.css">
</HEAD>
<BODY TEXT="Black" BGCOLOR="White" LINK="#CC9966" ALINK="#CC9966" VLINK="#CC9966">

<!-- Header -->
<TABLE WIDTH="100%" CELLSPACING="0" CELLPADDING="0" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
    &nbsp;Navigate: Home Page
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Contents -->
<CENTER>
<TABLE CELLSPACING="20" CELLPADDING="0" BORDER="0">
<TR>
    <TD ALIGN="CENTER" VALIGN="BOTTOM">
    <IMG SRC="./icone/library.png" WIDTH=226 HEIGHT=156 BORDER=0 ALT="" ALIGN="MIDDLE">
    </TD>
</TR>
<TR>
    <TD ALIGN="CENTER" VALIGN="TOP">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
    Please select an option below:
    </FONT>
    </TD>
</TR>
<TR>
    <TD ALIGN="CENTER">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
    <A HREF="books/books_index.php">Books</A>&nbsp;,&nbsp;
    <A HREF="reviews/reviews_index.php">Reviews</A>&nbsp;,&nbsp;
    <A HREF="articles/articles_index.php">Articles</A>&nbsp;,&nbsp;
    <A HREF="users/users_index.php">Users</A>&nbsp;,&nbsp;
    <A HREF="preference/preference_index.php" TARGET="contents">Preference</A>&nbsp;,&nbsp;
    <A HREF="#" TARGET="contents" onClick="javascript:window.open('./help/node_1.html','NE','scrollbars=1,location=0,menubar=0,toolbar=0,resizable=0,width=400,height=500')">Help on line</A>
    </FONT>
    </TD>
</TR>
<TR>
    <TD ALIGN="CENTER">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
    This program is Copyright under the <A HREF="COPYING">GNU Public License</A>.
    </FONT>
    </TD>
</TR>
</TABLE>
</CENTER>

</BODY>
</HTML>