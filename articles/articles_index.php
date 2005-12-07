<?php if (file_exists('../default.php')) { include '../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
<HEAD>
    <TITLE>Library - Articles</TITLE>
    <LINK REL="STYLESHEET" HREF="../library.css">
</HEAD>
<BODY TEXT="Black" BGCOLOR="White" LINK="#CC9966" ALINK="#CC9966" VLINK="#CC9966">

<!-- Header -->
<TABLE WIDTH="100%" CELLSPACING="0" CELLPADDING="0" BORDER="0">
<TR>
    <TD ALIGN="LEFT">
    <FONT FACE="Arial,Helvetica,Sans-serif" SIZE="2">
    &nbsp;Navigate: <A HREF="../contents.php" TARGET="contents">Home Page</A> : Articles
    </FONT>
    </TD>
</TR>
</TABLE>

<!-- Title -->
<CENTER><H2>Articles</H2></CENTER>

<FORM ACTION="articles_list.php">
<UL>
    <LI>&nbsp;Please enter search word then press "Article list":<BR>
        &nbsp;<INPUT TYPE="TEXT" NAME="string1" SIZE="10">
        <SELECT NAME="op1" SIZE="1">
            <OPTION VALUE="AND" SELECTED>AND</OPTION>
	        <OPTION VALUE="OR">OR</OPTION>
        </SELECT>
        <INPUT TYPE="TEXT" NAME="string2" SIZE="10">
        <SELECT NAME="op2" SIZE="1">
            <OPTION VALUE="AND">AND</OPTION>
	        <OPTION VALUE="OR">OR</OPTION>
        </SELECT>
        <INPUT TYPE="TEXT" NAME="string3" SIZE="10">
        <INPUT TYPE="SUBMIT" VALUE="Article list">
</UL>
</FORM>
<UL>
    <LI>&nbsp;<A HREF="secure/articles_insert.php">Insert a new article</A><IMG SRC="../icone/ico_protected.gif" WIDTH="45" HEIGHT="15" BORDER="0" HSPACE="5" ALT="This link is password protected" ALIGN="ABSMIDDLE">
</UL>

</BODY>
</HTML>