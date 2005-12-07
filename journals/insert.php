<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<?php if (file_exists('../procedure/review_head.php')) { include '../procedure/review_head.php'; } ?>

<!-- Header -->
<TABLE BGCOLOR="#000000" WIDTH="100%" CELLSPACING="1" CELLPADDING="2" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White">
    &nbsp;Navigate: <A HREF="../index.php">Home Page</A> : <A HREF="reviews.php">Reviews</A> : Insert a Review
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Insert a Review</H2></CENTER>

<FORM METHOD="GET" ACTION="insert_commit.php">
Please enter review description, then press "Insert" button to commit:<BR>
<BR>
<TEXTAREA NAME="note" ROWS="6" COLS="65"></TEXTAREA><BR>
<BR>
<CENTER><INPUT TYPE="SUBMIT" VALUE="Insert">&nbsp;<INPUT TYPE="RESET" VALUE="Reset"></CENTER>
</FORM>

<?php if (file_exists('../procedure/review_tail.php')) { include '../procedure/review_tail.php'; } ?>

</BODY>
</HTML>