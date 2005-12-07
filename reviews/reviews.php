<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<?php if (file_exists('../procedure/review_head.php')) { include '../procedure/review_head.php'; } ?>

<!-- Header -->
<TABLE BGCOLOR="#000000" WIDTH="100%" CELLSPACING="1" CELLPADDING="2" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">
    &nbsp;Navigate: <A HREF="../index.php">Home Page</A> : Reviews
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Reviews</H2></CENTER>

<UL>
    <LI>&nbsp;<A HREF="list.php">Reviews list</A>
    <LI>&nbsp;<A HREF="insert.php">Insert a review</A>
    <LI>&nbsp;Draw a review
    <LI>&nbsp;Deposit a review
    <LI>
    <LI>&nbsp;Who has a certain review ?
    <LI>
    <LI>&nbsp;Review Position
    <LI>&nbsp;Insert a new user
</UL>

<?php if (file_exists('../procedure/review_tail.php')) { include '../procedure/review_tail.php'; } ?>

</BODY>
</HTML>