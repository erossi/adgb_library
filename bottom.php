<?php if (file_exists('default.php')) { include 'default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
<HEAD>
    <TITLE><?php print $prog_name; ?></TITLE>
    <LINK REL="STYLESHEET" HREF="library.css">
</HEAD>
<BODY TEXT="Black" BGCOLOR="Black" LINK="#CC9966" ALINK="#CC9966" VLINK="#CC9966">

<TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
<TR>
    <TD ALIGN="LEFT"  VALIGN="TOP">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">
    &nbsp;Go to section: 
    <A HREF="books/books_index.php" TARGET="contents">Books</A>&nbsp;:&nbsp;
    <A HREF="reviews/reviews_index.php" TARGET="contents">Reviews</A>&nbsp;:&nbsp;
    <A HREF="articles/articles_index.php" TARGET="contents">Articles</A>&nbsp;:&nbsp;
    <A HREF="users/users_index.php" TARGET="contents">Users</A>&nbsp;:&nbsp;
    <A HREF="preference/preference_index.php" TARGET="contents">Preference</A>
    </FONT></TD>
    <TD ALIGN="RIGHT" VALIGN="TOP"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">Powered by <A HREF="http://www.tecnobrain.com">TecnoBrain<IMG SRC="icone/logo_tecnobrain.gif" WIDTH="16" HEIGHT="18" BORDER="0" ALT="Powered by TecnoBrain" ALIGN="ABSMIDDLE"></A>&nbsp;</FONT></TD>
</TR>
</TABLE>

</BODY>
</HTML>