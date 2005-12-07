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
    <TD ALIGN="LEFT"  VALIGN="BOTTOM"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White"><A HREF="contents.php" TARGET="contents"><IMG SRC="icone/ico_home.gif" WIDTH="21" HEIGHT="20" BORDER="0" ALT="Go to Home Page"></A></FONT></TD>
    <TD ALIGN="RIGHT" VALIGN="BOTTOM"><FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2" STYLE="color: White"><?php print $prog_name . ' Version ' . $prog_version; ?>&nbsp;<IMG SRC="icone/logo_tecnobrain.gif" WIDTH="16" HEIGHT="18" BORDER="0" ALT="Powered by TecnoBrain" ALIGN="ABSMIDDLE"></A>&nbsp;</FONT></TD>
</TR>
</TABLE>

</BODY>
</HTML>