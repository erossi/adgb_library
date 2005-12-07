<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<?php if (file_exists('../procedure/book_head.php')) { include '../procedure/book_head.php'; } ?>

<!-- Header -->
<TABLE BGCOLOR="#000000" WIDTH="100%" CELLSPACING="1" CELLPADDING="2" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">
    &nbsp;Navigate: <A HREF="../index.php">Home Page</A> : Books
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Books</H2></CENTER>

<UL>
    <LI>&nbsp;<A HREF="books_list.php">Books list</A>
    <LI>&nbsp;Insert a book
    <LI>&nbsp;Draw a book
    <LI>&nbsp;Deposit a book
    <LI>
    <LI>&nbsp;Who has a certain book ?
    <LI>
    <LI>&nbsp;Review Position
    <LI>&nbsp;Insert a new user
</UL>

<?php if (file_exists('../procedure/book_tail.php')) { include '../procedure/book_tail.php'; } ?>

</BODY>
</HTML>