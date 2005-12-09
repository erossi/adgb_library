<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/review_head.php')) { include '../procedure/review_head.php'; } ?>

<!-- Header -->
<TABLE BGCOLOR="#000000" WIDTH="100%" CELLSPACING="1" CELLPADDING="2" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">
    &nbsp;Navigate: <A HREF="../index.php">Home Page</A> : <A HREF="reviews.php">Reviews</A> : Insert a Review : Commit
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Insert a Review</H2></CENTER>

<?php
    print 'Text:<BR><PRE>';
    print $note;
    print '</PRE><BR><BR>';
    print 'NOTE: Manca la scrittura su database. Correggere il link a "Insert in alto" in maniera che usi javascript x tornare indietro di 1 pagina';
?>

<?php if (file_exists('../procedure/review_tail.php')) { include '../procedure/review_tail.php'; } ?>

</BODY>
</HTML>